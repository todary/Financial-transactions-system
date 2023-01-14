<?php

namespace Tests\Unit;

use App\AccountData;
use App\Main;
use PHPUnit\Framework\TestCase;

class MainOperationsTest extends TestCase
{
    public Main $mainObj;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->mainObj = new Main();
    }


    public function testCreateAccount()
    {
        $this->mainObj->addAccount(new AccountData("123", 100));


        $this->assertTrue(isset($this->mainObj->accounts["123"]));
        $this->assertFalse(isset($this->mainObj->accounts["012"]));
    }

    public function testDepositIsWorking()
    {
        $this->mainObj->addAccount(new AccountData("123", 100));
        $this->mainObj->depositToAccount("123", 300);

        $this->assertTrue($this->mainObj->accounts["123"]->getWalletAmount()==400);
        $this->assertTrue(count($this->mainObj->getAccountTransactionsLog("123"))==2);
    }

    public function testWithdrawIsWorking()
    {
        $this->mainObj->addAccount(new AccountData("123", 100));
        $this->mainObj->withdrawFromAccount("123", 50);

        $this->assertTrue($this->mainObj->accounts["123"]->getWalletAmount()==50);
        $this->assertTrue(count($this->mainObj->getAccountTransactionsLog("123"))==2);
    }

    public function testTransferFromTHeFirstAccountToTheSecondAccount()
    {
        $this->mainObj->addAccount(new AccountData("123", 500));
        $this->mainObj->addAccount(new AccountData("456", 400));

        $this->mainObj->transferFromTHeFirstAccountToTheSecondAccount("123", "456", 100);

        $this->assertTrue($this->mainObj->accounts["123"]->getWalletAmount()==400);
        $this->assertTrue($this->mainObj->accounts["456"]->getWalletAmount()==500);
        $this->assertTrue(count($this->mainObj->getAccountTransactionsLog("123"))==2);
        $this->assertTrue(count($this->mainObj->getAccountTransactionsLog("456"))==2);
    }

    public function testGetAllAccountsInTheSystem()
    {
        $this->mainObj->addAccount(new AccountData("123", 500));
        $this->mainObj->addAccount(new AccountData("456", 400));

        var_dump("");
        $this->mainObj->showAllAccounts();
        $this->assertTrue(true);
    }

    public function testGetTheBalanceOfaSpecificAccount()
    {
        $this->mainObj->addAccount(new AccountData("123", 100));

        $this->assertTrue($this->mainObj->accounts["123"]->getWalletAmount()==100);
    }

    public function testGetAllAccountTransactionsSortedByComments()
    {
        $this->mainObj->addAccount(new AccountData("1", 100));

        $this->mainObj->depositToAccount("1", 400);
        $this->mainObj->depositToAccount("1", 500);
        $this->mainObj->withdrawFromAccount("1", 100);

        var_dump("");

        $this->mainObj->allAccountTransactionsSortedByComment("1");

        $this->assertTrue(true);
    }

    public function testGetAllAccountTransactionsSortedByDateTime()
    {
        $this->mainObj->addAccount(new AccountData("1", 100));
        sleep(1);

        $this->mainObj->depositToAccount("1", 400);
        sleep(1);

        $this->mainObj->depositToAccount("1", 500);

        $this->mainObj->withdrawFromAccount("1", 100);

        $this->mainObj->allAccountTransactionsSortedByDate("1");

        $this->assertTrue(true);
    }
}
