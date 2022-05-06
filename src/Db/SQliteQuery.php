<?php

namespace App\Db;

class SQliteQuery
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

    public function getReviews()
    {
        $stmt = $this->pdo->query('SELECT ID, username, text_review ' . 'FROM reviews');
        
        $reviews = [];
        
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $reviews[] = [
                'ID' => $row['ID'],
                'username' => $row['username'],
                'text_review' => $row['text_review']
            ];
        }

        return $reviews;
    }

    public function getReviewByID($id) {
        $stmt = $this->pdo->prepare('SELECT ID, username, text_review FROM reviews WHERE ID = :id');
        $stmt->execute([':id' => $id]);

        $review = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $review[] = [
                'ID' => $row['ID'],
                'username' => $row['username'],
                'text_review' => $row['text_review']
            ];
        }

        return $review;
    }
}
