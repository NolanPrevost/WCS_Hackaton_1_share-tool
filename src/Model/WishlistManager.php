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
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (name, price, vote) VALUES (:name, :price, :vote)");
        $statement->bindValue('name', $wishItem['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $wishItem['price'], \PDO::PARAM_STR);
        $statement->bindValue('vote', $wishItem['vote'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update wishItem in database
     */
    public function update(array $wishItem): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET name = :name, price = -price WHERE id=:id");
        $statement->bindValue('id', $wishItem['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $wishItem['name'], \PDO::PARAM_STR);
        $statement->bindValue('price', $wishItem['price'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
