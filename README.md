# Project Title
Financial transactions system


## TASK
We expect you to use SOLID, GRASP principles, design patterns. Code check must be passed by phpstan, phpcs analyzers. In README file in the test task you should describe which patterns did you use and why.
Only business logic code required. MVC pattern is forbidden, UI Interface is not required because there is no reason for start application. That means you should not write controllers and views.

Task Question:
Implement a set of classes for managing the financial operations of an account.
There are three types of transactions: deposits, withdrawals and transfer from account to account.
The transaction contains a comment, an amount, and a due date.

## Requirements and Output

    • get all accounts in the system.
    • get the balance of a specific account
    • perform an operation
    • get all account transactions sorted by comment in alphabetical order.
    • get all account transactions sorted by date.
The test task must be implemented without the use of frameworks and databases. This is necessary in order to see your coding style, ability to understand and implement the task and demonstrate your skills.

## Installation
Using Composer :

```
composer install
```

If you don't have composer, you can get it from [Composer](https://getcomposer.org/)


## How to  Run the application

### To get all accounts in the system 
```
./vendor/phpunit/phpunit/phpunit --filter testGetAllAccountsInTheSystem
```

#### To get the balance of a specific account
```
./vendor/phpunit/phpunit/phpunit --filter testGetTheBalanceOfaSpecificAccount
```


#### To perform an operation Deposit
```
./vendor/phpunit/phpunit/phpunit --filter testDepositIsWorking
```


#### To perform an operation Withdraw
```
./vendor/phpunit/phpunit/phpunit --filter testWithdrawIsWorking
```

#### To perform an operation TransferFrom
```
./vendor/phpunit/phpunit/phpunit --filter testTransferFromTHeFirstAccountToTheSecondAccount
```


### To get all account transactions sorted by comment in alphabetical order
```
./vendor/phpunit/phpunit/phpunit --filter testGetAllAccountTransactionsSortedByComments
```


#### To get all account transactions sorted by date
```
./vendor/phpunit/phpunit/phpunit --filter testGetAllAccountTransactionsSortedByDateTime
```



#### To CreateAccount
```
./vendor/phpunit/phpunit/phpunit --filter testCreateAccount
```


## Tests
To run tests make sure you are in the main folder, and then you can run this command line :

```
./vendor/bin/phpunit

```

## What did I use?
### SOLID
```
    • Single: Every class is used for single purpose only
    • Open-close : for add another action wirtoud edditing old code
    • Liskov Substitution  : in doAction in Account data
    • Dependency Inversion : to invert TransactionAction in parameter method doAction
```

### Design patterns
```
  • Used Adapter Design Patter in Actions Directory by create interface and its concretes implement it
```
### Static Analyzer
```
    • phpstan : level 4
    • phpcs   : PSR2
```

