<?php

namespace App\Model;

class ReservationManager extends AbstractManager
{
    public const TABLE = 'reservation';

    public function insertReservation(array $reservation, int $id)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (user_id, tool_id, tool_booking_start, tool_booking_end)
        VALUES (:user_id, :tool_id, :tool_booking_start, :tool_booking_end)");
        $statement->bindValue('user_id', $reservation['user_id'], \PDO::PARAM_STR);
        $statement->bindValue('tool_id', $id, \PDO::PARAM_STR);
        $statement->bindValue('tool_booking_start', $reservation['booking_start'], \PDO::PARAM_STR);
        $statement->bindValue('tool_booking_end', $reservation['booking_end'], \PDO::PARAM_STR);

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
        $query = 'SELECT * FROM ' . static::TABLE . ' WHERE user_id = 1';
        return $this->pdo->query($query)->fetchAll();
    }

    public function selectReservationByToolId($id): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . static::TABLE . ' WHERE tool_id = :id');
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
