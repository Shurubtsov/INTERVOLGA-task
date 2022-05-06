<?php

namespace App\Controller;
use App\Db\SQliteConnection;
use App\Db\SQliteCreateTable;

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
}
