<?php
/* Class for database insert, delete, update etc. */

namespace App;

require_once __DIR__ . "/../vendor/autoload.php";

use App\Db\SQliteConnection;
use App\Db\SQliteInsert;
use App\Db\SQliteQuery;
use App\Db\SQliteCreateTable;
use Exception;

class Storage
{

    // inserting data to db
    public function insertData($username, $text_review)
    {
        $pdo = (new SQliteConnection())->connect();
        $sqlite = new SQliteInsert($pdo);

        $sqlite->insertReview($username, $text_review);
    }

    // get list of reviews from db
    public function getAllReviews($page, $limit)
    {
        $pdo = (new SQliteConnection())->connect();
        $query = new SQliteQuery($pdo);

        $reviews = $query->getReviews($page, $limit);

        return $reviews;
    }

    // get one review from database
    public function getReviewByID($id)
    {
        $pdo = (new SQliteConnection())->connect();
        $query = new SQliteQuery($pdo);

        $review = $query->getReviewByID($id);

        return $review;
    }

    // delete review from db on id
    public function deleteReview($id)
    {
        $pdo = (new SQliteConnection())->connect();
        $query = new SQliteQuery($pdo);
        $query->deleteReview($id);
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
}
