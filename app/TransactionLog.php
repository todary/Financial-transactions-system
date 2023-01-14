<?php

namespace App;

class TransactionLog
{
    public string $accountNum;
    public float  $moneyAmount;
    public string $comment;
    public string $createdAt;

    public function __construct(string $accountNum, float $moneyAmount, string $comment)
    {
        $this->accountNum   = $accountNum;
        $this->moneyAmount  = $moneyAmount;
        $this->comment      = $comment;
        $this->createdAt    = date("Y-m-d H:i:s");
    }
}
