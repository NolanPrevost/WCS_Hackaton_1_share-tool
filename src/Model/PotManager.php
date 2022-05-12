<?php

namespace App\Model;

class PotManager extends AbstractManager
{
    public const TABLE = 'pot';

    /**
     * Insert new item in database
     */
    public function insert(array $pot): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`amount`) VALUES (:amount)");
        $statement->bindValue('amount', $pot['amount'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $pot): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `amount` = :amount WHERE id=:id");
        $statement->bindValue('id', $pot['id'], \PDO::PARAM_INT);
        $statement->bindValue('amount', $pot['amount'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
