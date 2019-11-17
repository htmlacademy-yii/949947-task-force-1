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
     * Возвращает первую строку из csv файла( имена столбцов)
     *
     * @return string
     * @throws SourceFileException
     */
    private function getFirstLine(): string
    {
        $nameColumn = array();
        $openSrcFile = fopen($this->path, 'r');

        if (!file_exists($this->path)) {
            throw new SourceFileException("Файл не существует");
        }

        if (!$openSrcFile) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        $firstLine = fgetcsv($openSrcFile, PHP_EOL);
        foreach ($firstLine as $word) {
            $nameColumn[] = '`' . $word . '`';
        }
        return implode($nameColumn, ' ,');
    }

    /**
     * Возвращает имя таблицы
     *
     * @return string
     */
    private function getTableName(): string
    {
        $tableName = '`' . $this->dataTableName . '`';
        return $tableName;
    }

    /**
     * Возвращает информацию из csv файла ,которая будет заполняться в БД
     *
     * @return array
     */
    private function readCsv()
    {
        $result = array();
        $file = new SplFileObject($this->path);

        while (!$file->eof()) {

            $result[] = $file->fgetcsv();
        }
        array_shift($result);//удаляет первый элемент массива(первую строчку, которая явлеяется именами столбцов)
        array_pop($result);//удаляет последний пустой элемент массива

        return $result;
    }

    /**
     * Возвращает массив с готовыми sql запросами на дамп информации в таблицу
     *
     * @return array
     * @throws SourceFileException
     */
    private function creatSqlRequest()
    {
        $sqlRequest = array();
        foreach ($this->readCsv() as $line) {
            $sqlRequest[] = "INSERT INTO " . $this->getTableName() . " (" . $this->getFirstLine() . ") " . " VALUES(" . "'" . implode($line,
                    "','") . "'" . ")" . ";" . PHP_EOL;
        }

        return $sqlRequest;
    }

    /**
     * Записывает запросы в файл sql
     *
     * @throws SourceFileException
     */
    public function writeSqlFile()
    {

        $openFile = fopen($this->sqlPath, 'w');
        if (!file_exists($this->path)) {
            throw new SourceFileException("Файл не существует");
        }

        if (!$openFile) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        fwrite($openFile, implode($this->creatSqlRequest()));
    }
}
