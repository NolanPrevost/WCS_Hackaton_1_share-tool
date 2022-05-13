<?php

namespace App\Model;

class VoteManager extends AbstractManager
{
    public const TABLE = 'vote';

    /**
     * Insert new vote in database
     */
    public function insert(array $vote): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (
            `vote`, `user_id`, `wishlist_id`) VALUES (:vote, :user_id, :wishlist_id)");
        $statement->bindValue('vote', $vote['vote'], \PDO::PARAM_INT);
        $statement->bindValue('user_id', $vote['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('wishlist_id', $vote['wishlist_id'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update vote in database
     */
    public function update(array $vote): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `vote` = :vote, `user_id,` = :user_id, `wishlist_id,` = :wishlist_id WHERE id=:id");
        $statement->bindValue('id', $vote['id'], \PDO::PARAM_INT);
        $statement->bindValue('vote', $vote['vote'], \PDO::PARAM_INT);
        $statement->bindValue('user_id', $vote['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('wishlist_id', $vote['wishlist_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    /**
     * Get all rows from database.
     */
    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = "SELECT v.user AS user_id, v.wishlist AS wishlist_id, v.vote 
        FROM " . static::TABLE . " AS v
        INNER JOIN user AS u ON v.user = v.id
        INNER JOIN wishlist AS w ON v.wishlist = w.id";
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }


    public function selectVoteByWishId(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare('SELECT v.wishlist_id, v.vote, v.user_id
        FROM ' . static::TABLE . ' AS v
        INNER JOIN user AS u ON v.user_id = v.id
        INNER JOIN wishlist AS w ON v.wishlist_id = w.id
        WHERE wishlist_id = :id');

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
