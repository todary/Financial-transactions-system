<?php

namespace App;

use App\Actions\TransactionAction;

class AccountData
{
    private string $accountNum;
    private float $walletAmount;

    public function __construct(string $accountNum, float $walletAmount)
    {
        $this->accountNum   = $accountNum;
        $this->walletAmount = $walletAmount;
    }

    public function getWalletAmount(): float
    {
        return $this->walletAmount;
    }

    public function setAmount(float $walletAmount)
    {
        $this->walletAmount = $walletAmount;
    }

    public function getAccountNum(): string
    {
        return $this->accountNum;
    }

    public function doAction(TransactionAction $action, float $moneyAmount, string $comment = null): TransactionLog
    {
        return $action->doAction($this, $moneyAmount, $comment);
    }
}
