<?php

namespace App\Services\Slot;

use App\Enums\SlotWebhookResponseCode;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Slot\Dto\RequestTransaction;

class SlotWebhookValidator
{
    protected ?User $member;

    protected ?Transaction $existingTransaction;

    // TODO: imp: chang with actual wager
    protected ?Transaction $existingWager;

    protected float $totalTransactionAmount = 0;

    protected float $before_balance;

    protected float $after_balance;

    protected array $response;

    /**
     * 
     * @var RequestTransaction[]
     */
    protected $requestTransactions;

    protected RequestTransaction $requestTransaction;

    protected function __construct(protected SlotWebhookRequest $request)
    {
    }

    public function validate()
    {
        if (!$this->isValidSignature()) {
            return $this->response(SlotWebhookResponseCode::InvalidSign);
        }

        if (!$this->getMember()) {
            return $this->response(SlotWebhookResponseCode::MemberNotExists);
        }

        foreach ($this->request->getTransactions() as $transaction) {
            $requestTransaction = RequestTransaction::from($transaction);

            $this->requestTransactions[] = $requestTransaction;

            if ($requestTransaction->TransactionID && !$this->isNewTransaction($requestTransaction)) {
                return $this->response(SlotWebhookResponseCode::DuplicateTransaction);
            }

            if (!in_array($this->request->getMethodName(), ["placebet", "bonus", "jackpot", "buyin", "buyout", "pushbet"]) && $this->isNewWager($requestTransaction)) {
                return $this->response(SlotWebhookResponseCode::BetNotExist);
            }

            $this->totalTransactionAmount += $requestTransaction->TransactionAmount;
        }

        if ($this->request->filled("Transaction")) {
            $this->requestTransaction = RequestTransaction::from($this->request->getTransaction());

            if ($this->requestTransaction->TransactionID && !$this->isNewTransaction($this->requestTransaction)) {
                return $this->response(SlotWebhookResponseCode::DuplicateTransaction);
            }

            if (!in_array($this->request->getMethodName(), ["placebet", "bonus", "jackpot", "buyin", "buyout", "pushbet"]) && $this->isNewWager($this->requestTransaction)) {
                return $this->response(SlotWebhookResponseCode::BetNotExist);
            }

            $this->totalTransactionAmount += $this->requestTransaction->TransactionAmount;
        }

        if (!$this->hasEnoughBalance()) {
            return $this->response(SlotWebhookResponseCode::MemberInsufficientBalance);
        }

        return $this;
    }

    protected function isValidSignature()
    {
        $method = $this->request->getMethodName();
        $operatorCode = $this->request->getOperatorCode();
        $requestTime = $this->request->getRequestTime();

        $secretKey = $this->getSecretKey();

        $signature = md5($operatorCode . $requestTime . $method . $secretKey);

        return $this->request->getSign() == $signature;
    }

    public function getMember()
    {
        if (!isset($this->member)) {
            $this->member = User::where("user_name", $this->request->getMemberName())->first();
        }

        return $this->member;
    }

    protected function isNewWager(RequestTransaction $transaction)
    {
        return !$this->getExistingWager($transaction);
    }

    public function getExistingWager(RequestTransaction $transaction)
    {
        if (!isset($this->existingWager)) {
            $this->existingWager = Transaction::where("wager_id", $transaction->WagerID)->first();
        }

        return $this->existingWager;
    }

    protected function isNewTransaction(RequestTransaction $transaction)
    {
        return !$this->getExistingTransaction($transaction);
    }

    public function getExistingTransaction(RequestTransaction $transaction)
    {
        if (!isset($this->existingTransaction)) {
            $this->existingTransaction = Transaction::where("external_transaction_id", $transaction->TransactionID)->first();
        }

        return $this->existingTransaction;
    }

    public function getAfterBalance()
    {
        if (!isset($this->after_balance)) {
            $this->after_balance = $this->getBeforeBalance() + $this->totalTransactionAmount;
        }

        return $this->after_balance;
    }

    public function getBeforeBalance()
    {
        if (!isset($this->before_balance)) {
            $this->before_balance = $this->getMember()->balance;
        }

        return $this->before_balance;
    }

    protected function hasEnoughBalance()
    {
        return $this->getAfterBalance() >= 0;
    }

    public function getRequestTransactions()
    {
        return $this->requestTransactions;
    }

    public function getRequestTransaction()
    {
        return $this->requestTransaction;
    }

    protected function getSecretKey()
    {
        return config("game.api.secret_key");
    }

    protected function response(SlotWebhookResponseCode $responseCode)
    {
        $this->response = SlotWebhookService::buildResponse(
            $responseCode,
            $this->getMember() ? $this->getAfterBalance() : 0,
            $this->getMember() ? $this->getBeforeBalance() : 0
        );

        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function fails()
    {
        return isset($this->response);
    }

    public static function make(SlotWebhookRequest $request)
    {
        return new self($request);
    }
}
