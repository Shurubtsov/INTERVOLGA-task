<?php

namespace App\Db;

class SQliteInsert
{

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertReview($username, $text_review)
    {
        $sql = 'INSERT INTO reviews(username, text_review) '
            . 'VALUES(:username, :text_review);';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':text_review' => $text_review,
        ]);

        return $this->pdo->lastInsertId();
    }
}
