<?php

namespace App\Model;

class ToolManager extends AbstractManager
{
  public const TABLE = 'tool';

  /**
   * Insert new tool in database
   */
  public function insert(array $tool): int
  {
    $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
    $statement->bindValue('title', $tool['title'], \PDO::PARAM_STR);

    $statement->execute();
    return (int)$this->pdo->lastInsertId();
  }

  /**
   * Update tool in database
   */
  public function update(array $tool): bool
  {
    $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
    $statement->bindValue('id', $tool['id'], \PDO::PARAM_INT);
    $statement->bindValue('name', $tool['name'], \PDO::PARAM_STR);
    $statement->bindValue('booking_start', $tool['booking_start'], \PDO::PARAM_STR);
    $statement->bindValue('booking_end', $tool['booking_end'], \PDO::PARAM_STR);
    $statement->bindValue('image', $tool['image'], \PDO::PARAM_STR);

    return $statement->execute();
  }

}