<?php

namespace App\Db;

/*
    * SQLite create table 
    */

class SQliteCreateTable
{
    private $pdo;

    /* connect to the SQLite database */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /* create table */
    public function createTable() {
        $commands = ['CREATE TABLE IF NOT EXISTS reviews (
            ID   INTEGER PRIMARY KEY,
            username TEXT NOT NULL,
            text_review TEXT NOT NULL
          );'];
        
        foreach($commands as $command) {
            $this->pdo->exec($command);
        }
    }
}
