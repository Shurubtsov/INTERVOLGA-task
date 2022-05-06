<?php

namespace App\Controller;

use App\Db\SQliteConnection;
use App\Db\SQliteCreateTable;
use Exception;

class Db
{
    public function connect()
    {
        $pdo = (new SQliteConnection())->connect();
        if ($pdo != null) {
            return 'Connect to SQLite db is successful';
        } else {
            return 'Connect to SQLite db denied, something went wrong';
        }
    }

    public function createTable()
    {
        $sqlite = new SQliteCreateTable((new SQliteConnection())->connect());
        $message = '';
        try {
            $sqlite->createTable();
            $message = 'Database table is created';
        } catch (Exception $e) {
            $message = 'ERROR: cant create table: ' . $e->getMessage();
        }

        return $message;
    }

    public function getTable()
    {
        $sqlite = new SQliteCreateTable((new SQliteConnection())->connect());
        $tables = $sqlite->createTable();

        return $tables;
    }
}
