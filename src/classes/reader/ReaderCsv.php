<?php

namespace Academy\classes\reader;

use Academy\classes\exception\SourceFileException;
use SplFileObject;

class ReaderCsv
{
    private $path;
    private $dataTableName;
    private $sqlPath;

    public function __construct($path, $sqlPath)
    {
        $this->path = $path;
        $this->sqlPath = $sqlPath;
        $this->dataTableName = basename($path, '.csv');
    }

    /**
     * считывает данные из csv файла и записывает в sql файл в виде INSERT - запроса
     *
     * @return void
     * @throws SourceFileException
     */
    public function csvSqlParser(): void
    {
        if (!file_exists($this->path)) {
            throw new SourceFileException('Такой файл отсутствует');
        }

        $file = new SplFileObject($this->path);

        if ($file->getExtension() != 'csv') {
            throw new SourceFileException('Не верный формат файла');
        }

        if ($file->key() === 0) {
            $columnName = $file->fgetcsv();//получили имя столбцов
        }

        $tableName = $this->dataTableName;// получили название таблицы

        $result = array();

        while (!$file->eof()) {

            $result[] = $file->fgetcsv();
        }

        array_pop($result);//удаляет последний пустой элемент массива

        $format = 'INSERT INTO `%1$s` (`%2$s`) VALUE(\'%3$s\');';

        $sqlRequest = array();
        foreach ($result as $line) {
            $sqlRequest[] = sprintf($format, $tableName, implode($columnName, '`,`'), implode($line, '\',\''));
        }

        $openFile = new SplFileObject($this->sqlPath, 'w');

        if (!file_exists($this->sqlPath)) {
            throw new SourceFileException('Такой файл отсутствует');
        }

        $openFile->fwrite(implode($sqlRequest, "\n"));
    }
}
