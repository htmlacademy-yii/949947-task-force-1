<?php

use Academy\classes\taskStatus;

require_once './vendor/autoload.php';

$idCustomer = 1;
$idException = 2;
$idInitiator = 1;

$task = new taskStatus($idCustomer, $idException);

var_dump($task->getNextStatus('cancel'));
