<?php

namespace App\Actions;

use App\AccountData;
use App\TransactionLog;

class DepositAction implements TransactionAction
{
    public function doAction(AccountData $account, float $moneyAmount, string $comment = null):TransactionLog
    {
        if ($comment == null) {
            $comment = "New Deposit (${moneyAmount}) is done";
        }

        $account->setAmount($account->getWalletAmount() + $moneyAmount);
        return (new TransactionLog($account->getAccountNum(), $moneyAmount, $comment));
    }
}
