<?php

namespace App\Services\Slot;

use App\Enums\SlotWebhookResponseCode;
use App\Http\Requests\Slot\SlotWebhookRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Slot\Dto\SlotTransaction;

class ValidateSlotWebHookService
{
    protected User $member;

    protected Transaction $existingTransaction;

    protected float $after_balance;

    public function __construct(public SlotWebhookRequest $request)
    {
    }

    public function validate()
    {
        if (!$this->isValidSignature($this->request)) {
            return $this->response(SlotWebhookResponseCode::InvalidSign);
        }

        $member = $this->getMember($this->request);

        if (!$member) {
            return $this->response(SlotWebhookResponseCode::MemberNotExists);
        }

        foreach($this->request->getTransactions() as $transaction){
            $transaction = SlotTransaction::from($transaction);

            if(!$this->isNewTransaction($transaction)){
                return $this->response(SlotWebhookResponseCode::DuplicateTransaction);
            }

            if(!$this->hasEnoughBalance($transaction)){
                return $this->response(SlotWebhookResponseCode::MemberInsufficientBalance);
            }
        }

        if($this->request->filled("Transaction")){
            $transaction = SlotTransaction::from($this->request->getTransaction());

            if(!$this->isNewTransaction($transaction)){
                return $this->response(SlotWebhookResponseCode::DuplicateTransaction);
            }

            if(!$this->hasEnoughBalance($transaction)){
                return $this->response(SlotWebhookResponseCode::MemberInsufficientBalance);
            }
        }
    }

    public function calculateAfterBalance(SlotTransaction $transaction){
        $before_balance = $this->getMember()->balance;

        $this->after_balance = $before_balance + $transaction->TransactionAmount;

        return $this->after_balance;
    }

    public function hasEnoughBalance(){
        return $this->after_balance >= 0;
    }

    public function isValidSignature()
    {
        $method = $this->request->getMethodName();
        $operatorCode = $this->request->getOperatorCode();
        $requestTime = $this->request->getRequestTime();

        $secretKey = $this->getSecretKey();

        $signature = md5($operatorCode . $requestTime . $method . $secretKey);

        return $this->request->getSign() != $signature;
    }

    public function isNewTransaction(SlotTransaction $transaction){
        return !$this->getExistingTransaction($transaction);
    }

    public function getExistingTransaction(SlotTransaction $transaction)
    {
        if(!$this->existingTransaction){
            $this->existingTransaction = Transaction::where("external_transaction_id", $transaction->TransactionID)->first();
        }

        return $this->existingTransaction;
    }

    public function getMember()
    {
        if (!$this->member) {
            // TODO: imp: check with member id instead of member name
            $this->member = User::where("user_name", $this->request->getMemberName())->first();
        }

        return $this->member;
    }

    protected function getSecretKey()
    {
        return config("game.api.secret_key");
    }

    public function response(SlotWebhookResponseCode $response_code, $before_balance = 0, $after_balance = 0)
    {
        return [
            "ErrorCode" => $response_code->value,
            "ErrorMessage" => $response_code->name,
            "Balance" => $after_balance,
            "BeforeBalance" => $before_balance
        ];
    }
}
