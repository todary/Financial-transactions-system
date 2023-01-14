<?php

namespace App\Actions;

use App\AccountData;
use App\TransactionLog;

interface TransactionAction
{
    public function doAction(AccountData $account, float $moneyAmount, string $comment = null):TransactionLog;
}
