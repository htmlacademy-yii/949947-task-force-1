<?php

use Academy\classes\reader\ReaderCsv;
use \Academy\classes\exception\SourceFileException;

require_once './vendor/autoload.php';

$path = 'D:\local\OSPanel\domains\localhost\data\cities.csv';
$sqlPath = 'D:\local\OSPanel\domains\localhost\test.sql';


$test = new ReaderCsv($path, $sqlPath);

try {
    $test->writeSqlFile();
} catch (SourceFileException $e) {
    echo $e;
}

