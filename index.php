<?php

require_once "vendor/autoload.php";

$mainObj = (new \App\Main());

$mainObj->depositToAccount("1", 400);
$mainObj->allAccountTransactionsSortedByDate("1");
