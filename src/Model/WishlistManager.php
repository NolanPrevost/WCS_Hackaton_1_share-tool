<?php

namespace App\Model;

class WishlistManager extends AbstractManager
{
    public const TABLE = 'wishlist';

    /**
     * Insert new wishItem in database
     */
    public function insert(array $wishItem): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        "(`name`, `price`, `image`, `website`) VALUES (:name, :price, :image, :website)");
        $statement->bindValue('name', $wishItem['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $wishItem['price'], \PDO::PARAM_STR);
        $statement->bindValue('image', $wishItem['image'], \PDO::PARAM_STR);
        // $statement->bindValue('image', $wishItem['image'], \PDO::PARAM_STR);
        $statement->bindValue('website', $wishItem['website'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update wishItem in database
     */
    public function update(array $wishItem): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `name` = :name, `price` = :price, `image` = :image, `website` = :website WHERE id=:id");
        $statement->bindValue('id', $wishItem['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $wishItem['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $wishItem['price'], \PDO::PARAM_STR);
        $statement->bindValue('image', $wishItem['image'], \PDO::PARAM_STR);
        $statement->bindValue('website', $wishItem['website'], \PDO::PARAM_STR);

        return $statement->execute();
    }


        /**
     * Update number of votes in database a vote
     */
    public function updateVote(int $wishItemId, int $vote): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `vote` = :vote WHERE id=:id");
        $statement->bindValue('id', $wishItemId, \PDO::PARAM_INT);
        $statement->bindValue('vote', $vote, \PDO::PARAM_INT);

        return $statement->execute();
    }
}
