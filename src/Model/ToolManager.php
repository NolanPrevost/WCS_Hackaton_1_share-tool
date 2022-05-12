<?php

namespace App\Model;

class ToolManager extends AbstractManager
{
    public const TABLE = 'tool';
    public function insert(array $tool): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $tool['title'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $tool): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $tool['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $tool['name'], \PDO::PARAM_STR);
        $statement->bindValue('booking_end', $tool['booking_start'], \PDO::PARAM_STR);
        $statement->bindValue('booking_end', $tool['booking_end'], \PDO::PARAM_STR);
        $statement->bindValue('image', $tool['image'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function toggleReservation(array $reservation, int $id)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET booking_start = :booking_start,
        booking_end = :booking_end, is_booked = :is_booked WHERE id=:id");
        $statement->bindValue('booking_start', $reservation['booking_start'], \PDO::PARAM_STR);
        $statement->bindValue('booking_end', $reservation['booking_end'], \PDO::PARAM_STR);
        $statement->bindValue('is_booked', 1, \PDO::PARAM_STR);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function toggleAnnulation(int $id)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET booking_start = null,
        booking_end = null, is_booked = :is_booked WHERE id=:id");
        $statement->bindValue('is_booked', 0, \PDO::PARAM_STR);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function selectAllReserved(): array
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' WHERE is_booked = 1';
        return $this->pdo->query($query)->fetchAll();
    }
}
