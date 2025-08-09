<?php

require_once 'DatabaseWrapper.php';

abstract class BaseModel implements DatabaseWrapper
{
    protected PDO $pdo;
    protected string $table;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $tableColumns, array $values): array
    {
        $columns = implode(", ", $tableColumns);
        $placeholders = rtrim(str_repeat("?, ", count($values)), ", ");
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);

        return $this->find((int)$this->pdo->lastInsertId());
    }

    public function update(int $id, array $values): array
    {
        $set = implode(", ", array_map(fn($col) => "$col = ?", array_keys($values)));
        $sql = "UPDATE {$this->table} SET $set WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($values) + [$id]);

        return $this->find($id);
    }

    public function find(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: [];
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

