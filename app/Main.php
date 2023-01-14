<?php

namespace App;

use App\Actions\DepositAction;
use App\Actions\WithDrawAction;

class Main
{
    public array $accounts = [];
    public array $transactionsLog;
    public string $mask = "|%5.5s |%-30.30s\n";

    public function __construct()
    {
        $this->accounts         = [];
        $this->transactionsLog  = [];
    }

    public function addAccount(AccountData $accountData)
    {
        $this->accounts[$accountData->getAccountNum()] = $accountData;
        $this->transactionsLog[] = new TransactionLog(
            $accountData->getAccountNum(),
            $accountData->getWalletAmount(),
            "start amount"
        );
    }

    public function showTransactionsLog($transactions)
    {
        $mask = "|%-20.30s |%-20.30s |%-20.30s |%-20.30s |%-20.30s\n";
        printf($mask, '#', 'Acc', 'Amount', 'Comment', 'DateTime');
        foreach ($transactions as $key => $row) {
            printf($mask, $key + 1, $row->accountNum, $row->moneyAmount, $row->comment, $row->createdAt);
        }
    }

    public function showAccountWallet($accountNum, $withoutHeader = false)
    {
        if (!isset($this->accounts[$accountNum])) {
            var_dump("invalid account");
            return;
        }

        if (!$withoutHeader) {
            printf($this->mask, 'Acc', 'Wallet');
        }

        printf($this->mask, $accountNum, $this->accounts[$accountNum]->getWalletAmount());
    }

    public function depositToAccount($accountNum, float $amount, $showTransactions = false)
    {
        $this->transactionsLog[] = $this->accounts[$accountNum]->doAction(new DepositAction(), $amount);

        if ($showTransactions) {
            $this->showTransactionsLog($this->getAccountTransactionsLog($accountNum));
            $this->showAccountWallet($accountNum);
        }
    }

    public function withdrawFromAccount($accountNum, float $amount, $showTransactions = false)
    {
        $this->transactionsLog[] = $this->accounts[$accountNum]->doAction(new WithDrawAction(), $amount);

        if ($showTransactions) {
            $this->showTransactionsLog($this->getAccountTransactionsLog($accountNum));
            $this->showAccountWallet($accountNum);
        }
    }

    public function transferFromTHeFirstAccountToTheSecondAccount(string $fromAcc, string $toAcc, float $amount)
    {
        var_dump("Before Transfer");
        $this->showAccountWallet($fromAcc);
        $this->showAccountWallet($toAcc, true);


        //transfer
        $this->transactionsLog[] = $this->accounts[$fromAcc]->doAction(
            new WithDrawAction(),
            $amount,
            "transfer from your account to another account, money amount 200"
        );
        $this->transactionsLog[] = $this->accounts[$toAcc]->doAction(
            new DepositAction(),
            $amount,
            "transfer to your account to another account, money amount 200"
        );

        var_dump("After Transfer");
        $this->showAccountWallet($fromAcc);
        $this->showAccountWallet($toAcc, true);
    }

    public function showAllAccounts()
    {
        $firstAccount = 0;
        foreach ($this->accounts as $key => $account) {
            $this->showAccountWallet($account->getAccountNum(), !($firstAccount++==0));
        }
    }

    public function getBalanceOfSpecificAccount(string $accountNum)
    {
        $this->showAccountWallet($accountNum);
    }

    public function getAccountTransactionsLog(string $accountNum): array
    {
        return array_filter($this->transactionsLog, function ($obj) use ($accountNum) {
            if ($obj->accountNum != $accountNum) {
                return false;
            }
            return true;
        });
    }

    public function allAccountTransactionsSortedByComment(string $accountNum)
    {
        $thisAccountTransactions = $this->getAccountTransactionsLog($accountNum);

        usort($thisAccountTransactions, function ($a, $b) {
            return
                strtolower(substr($a->comment, 0, 1)) >
                strtolower(substr($b->comment, 0, 1));
        });


        $this->showTransactionsLog($thisAccountTransactions);
    }

    public function allAccountTransactionsSortedByDate(string $accountNum)
    {
        $thisAccountTransactions = $this->getAccountTransactionsLog($accountNum);

        usort($thisAccountTransactions, function ($a, $b) {
            return
                strtotime($a->createdAt) >
                strtotime($b->createdAt);
        });

        $this->showTransactionsLog($thisAccountTransactions);
    }
}
