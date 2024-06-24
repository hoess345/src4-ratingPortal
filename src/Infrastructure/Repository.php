<?php

namespace Infrastructure;

use Application\Entities\Product;
use Application\Entities\Rating;
use Application\Entities\User;
use Application\Util\ProductData;
use Application\Util\RatingData;

class Repository implements
    \Application\Interfaces\UserRepository,
    \Application\Interfaces\ProductRepository,
    \Application\Interfaces\RatingRepository
{
    private $server;
    private $userName;
    private $password;
    private $database;

    // private helper methods
    private function getConnection()
    {
        $con = new \mysqli($this->server, $this->userName, $this->password, $this->database);
        if (!$con) {
            die('Unable to connect to database. Error: ' . mysqli_connect_error());
        }
        return $con;
    }

    private function executeQuery($connection, $query)
    {
        $result = $connection->query($query);
        if (!$result) {
            die("Error in query '$query': " . $connection->error);
        }
        return $result;
    }

    private function executeStatement($connection, $query, $bindFunc)
    {
        $statement = $connection->prepare($query);
        if (!$statement) {
            die("Error in prepared statement '$query': " . $connection->error);
        }
        $bindFunc($statement);
        if (!$statement->execute()) {
            die("Error executing prepared statement '$query': " . $statement->error);
        }
        return $statement;
    }

    public function __construct(string $server, string $userName, string $password, string $database)
    {
        $this->server = $server;
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
    }

    public function getUser(int $id): ?User
    {
        $user = null;
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'SELECT id, userName, passwordHash FROM users WHERE id = ?',
            function ($s) use ($id) {
                $s->bind_param('i', $id);
            }
        );
        $stat->bind_result($id, $userName, $passwordHash);
        if ($stat->fetch()) {
            $user = new User($id, $userName, $passwordHash);
        }
        $stat->close();
        $con->close();
        return $user;
    }

    public function getUserForUserName(string $userName): ?User
    {
        $user = null;
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'SELECT id, userName, passwordHash FROM users WHERE userName = ?',
            function ($s) use ($userName) {
                $s->bind_param('s', $userName);
            }
        );
        $stat->bind_result($id, $userName, $passwordHash);
        if ($stat->fetch()) {
            $user = new User($id, $userName, $passwordHash);
        }
        $stat->close();
        $con->close();
        return $user;
    }

    public function addUser(string $userName, string $passwordHash): void
    {
        $user = null;
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'INSERT INTO users (userName, passwordHash) VALUES (?, ?)',
            function ($s) use ($userName, $passwordHash) {
                $s->bind_param('ss', $userName, $passwordHash);
            }
        );
        $stat->close();
        $con->close();
    }

    public function getProductsForFilter(string $filter): array
    {
        if (empty($filter)) {
            return $this->getAllProducts();
        }
        $products = [];
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'SELECT id, producer, productName, username, rating, ratingCount FROM product WHERE productName LIKE ?
             OR producer LIKE ?',
            function ($s) use ($filter) {
                $s->bind_param('ss', $filter, $filter);
            }
        );
        $stat->bind_result($id, $producer, $productName, $username, $rating, $ratingCount);
        while ($stat->fetch()) {
            $products[] = new Product($id, $producer, $productName, $username, $rating, $ratingCount);
        }
        $stat->close();
        $con->close();
        return $products;
    }

    public function createProduct(string $productName, string $producer): int
    {
        $userName = $this->getUser($_SESSION['userId'])->getUserName();
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'INSERT INTO product (producer, productName, username, rating, ratingCount) VALUES (?, ?, ?, 0, 0)',
            function ($s) use ($producer, $productName, $userName) {
                $s->bind_param('sss', $producer, $productName, $userName);
            }
        );
        $id = $con->insert_id;
        $stat->close();
        $con->close();
        return $id;
    }

    public function getAllProducts(): array
    {
        $products = [];
        $con = $this->getConnection();
        $stat = $this->executeQuery($con, 'SELECT id, producer, productName, username, rating, ratingCount FROM product');
        while ($res = $stat->fetch_object()) {
            $products[] = new Product($res->id, $res->producer, $res->productName, $res->username, $res->rating, $res->ratingCount);
        }
        $stat->close();
        $con->close();
        return $products;
    }

    public function getRatingsForProduct(int $productId): array
    {
        $ratings = [];
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'SELECT username, date, rating, comment FROM rating WHERE productId = ?',
            function ($s) use ($productId) {
                $s->bind_param('i', $productId);
            }
        );
        $stat->bind_result($username, $date, $rating, $comment);
        while ($stat->fetch()) {
            $ratings[] = new Rating($username, $rating, $comment, $date, $productId);
        }
        $stat->close();
        $con->close();
        return $ratings;
    }

    public function addRating(Rating $rating): void
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'INSERT INTO rating (username, productId, rating, comment, date) VALUES (?, ?, ?, ?, ?)',
            function ($s) use ($rating) {
                $s->bind_param('siiss', $rating->getUsername(), $rating->getProductId(), $rating->getRating(), $rating->getComment(), $rating->getDate());
            }
        );
    }

    public function getProductById(int $id): ProductData
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'SELECT id, producer, productName, username, rating, ratingCount FROM product WHERE id = ?',
            function ($s) use ($id) {
                $s->bind_param('i', $id);
            }
        );
        $stat->bind_result($id, $producer, $productName, $username, $rating, $ratingCount);
        $stat->fetch();
        $stat->close();
        $con->close();
        return new ProductData($id, $producer, $productName, $username, $rating, $ratingCount);
    }

    public function getRatingForUserAndProduct(int $productId, string $userName): RatingData
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'SELECT username, date, rating, comment, productId FROM rating WHERE productId = ? AND username = ?',
            function ($s) use ($productId, $userName) {
                $s->bind_param('is', $productId, $userName);
            }
        );
        $stat->bind_result($username, $date, $rating, $comment, $productId);

        if (!$stat->fetch()) {
            $stat->close();
            $con->close();
            return new RatingData($userName, -1, '', '', $productId);
        }

        $stat->close();
        $con->close();
        return new RatingData($username, $rating, $comment, $date, $productId);
    }

    public function updateRating(RatingData $rating): void
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'UPDATE rating SET rating = ?, comment = ?, date = ? WHERE productId = ? AND username = ?',
            function ($s) use ($rating) {
                $s->bind_param('issis', $rating->rating, $rating->comment, $rating->date, $rating->productId, $rating->username);
            }
        );
        $stat->close();
        $con->close();
    }

    public function deleteRating(int $productId, string $userName)
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'DELETE FROM rating WHERE productId = ? AND username = ?',
            function ($s) use ($productId, $userName) {
                $s->bind_param('is', $productId, $userName);
            }
        );
        $stat->close();
        $con->close();
    }

    public function increaseRating(int $productId, string $userName)
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'UPDATE product SET ratingCount = ratingCount + 1 WHERE id = ?',
            function ($s) use ($productId) {
                $s->bind_param('i', $productId);
            }
        );
        $stat->close();
        $con->close();
    }

    public function updateRatingForProduct(int $productId)
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'UPDATE product SET rating = (SELECT AVG(rating) FROM rating WHERE productId = ?) WHERE id = ?',
            function ($s) use ($productId) {
                $s->bind_param('ii', $productId, $productId);
            }
        );
        $stat->close();
        $con->close();
    }

    public function decreaseRatingCount(int $productId)
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'UPDATE product SET ratingCount = ratingCount - 1 WHERE id = ?',
            function ($s) use ($productId) {
                $s->bind_param('i', $productId);
            }
        );
        $stat->close();
        $con->close();
    }

    public function updateProduct(int $id, string $producer, string $productName)
    {
        $con = $this->getConnection();
        $stat = $this->executeStatement($con,
            'UPDATE product SET producer = ?, productName = ? WHERE id = ?',
            function ($s) use ($producer, $productName, $id) {
                $s->bind_param('ssi', $producer, $productName, $id);
            }
        );
        $stat->close();
        $con->close();
    }
}