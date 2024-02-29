<?php

namespace App\Http\Requests\Slot;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SlotWebhookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $transaction_rules = [];

        if(in_array($this->getMethodName(), ["getbalance", "buyin", "buyout"])){
            $transaction_rules["Transactions"] = ["nullable"];
            if($this->getMethod() !== "getbalance"){
                $transaction_rules["Transaction"] = ["required"];
            }
        }else{
            $transaction_rules["Transactions"] = ["required"];
        }

        return [
            "MemberName" => ["required"],
            "OperatorCode" => ["required"],
            "ProductID" => ["required"],
            "MessageID" => ["required"],
            "RequestTime" => ["required"],
            "Sign" => ["required"],
            ...$transaction_rules
        ];
    }

    public function getMemberName(){
        return $this->get('MemberName');
    }

    public function getProductID(){
        return $this->get('ProductID');
    }

    public function getMessageID(){
        return $this->get('MessageID');
    }

    public function getMethodName(){
        return strtolower(str($this->url())->explode("/")->last());
    }

    public function getOperatorCode()
    {
        return $this->get('OperatorCode');
    }

    public function getRequestTime()
    {
        return $this->get('RequestTime');
    }

    public function getSign()
    {
        return $this->get('Sign');
    }

    public function getTransactions(){
        return $this->get("Transactions", []);
    }

    public function getTransaction(){
        return $this->get("Transaction", []);
    }
}
