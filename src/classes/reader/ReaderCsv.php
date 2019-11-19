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
            $columnNames = $file->fgetcsv();//получили имя столбцов
            $columnNames = array_map(function ($value) {
                return "`{$value}`";//ставит ковычки для каждого элемента массива
            }, $columnNames);
        }

        while (!$file->eof()) {

            $checkLine = $file->fgetcsv();//проверка на пустую строку
            if ($checkLine) {
                $infoFile[] = $checkLine;
            }
        }

        foreach ($infoFile as $value) {
            $result[] = implode(array_map(
                function ($value) {
                    return "'{$value}'";//добавляет ковычки для каждого элемента массива
                }
                , $value), ',');

            $resultNew = array_map(function ($item) {
                return "($item)";
            }, $result);//добавляет скобки вокруг каждой строчки value
        }

        //array_pop($result);//удаляет последний пустой элемент массива

        $format = 'INSERT INTO `%1$s` (%2$s) VALUES %3$s;';

        $sqlRequest[] = sprintf(
            $format,
            $this->dataTableName,
            implode($columnNames, ','),
            implode($resultNew, ',' . PHP_EOL));

        $openFile = new SplFileObject($this->sqlPath, 'w');

        if (!file_exists($this->sqlPath)) {
            throw new SourceFileException('Такой файл отсутствует');
        }

        $openFile->fwrite(implode($sqlRequest, "\n"));
    }
}
