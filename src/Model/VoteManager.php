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
            `firstname`, `flastname`) VALUES (:firstname, :lastname)");
        $statement->bindValue('firstname', $vote['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $vote['lastname'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update vote in database
     */
    public function update(array $vote): bool
    {
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET 
        `firstname` = :firstname, 
        `lastname` = :lastname WHERE id=:id"
        );
        $statement->bindValue('id', $vote['id'], \PDO::PARAM_INT);
        $statement->bindValue('firstname', $vote['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $vote['lastname'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
