<?php

    namespace App\Db;

    class SQliteConnection
    {
        // pdo instance
        private $pdo;

        // return in instance of the PDO object that connects to SQlite
        public function connect()
        {
            if ($this->pdo == null) {
                $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
            }
            return $this->pdo;
        }
    }
