<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{
    private \PDO $pdo;

    public function __construct(
        private ConfigInterface $config
    ) {
        $this->connect();
    }

    public function insert(string $table, array $data)
    {
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO manhwa.$table ($columns) VALUES ($binds)";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return $exception;
        }

        return (int) $this->pdo->lastInsertId();
    }

    public function first(string $table, array $conditions = []): ?array 
    {
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM  manhwa.$table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function get(string $table, array $conditions = [], array $order = [], int $limit = -1): array
    {
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM manhwa.$table $where";

        if (count($order) > 0) {
            $sql .= ' ORDER BY '.implode(', ', array_map(fn ($field, $direction) => "$field $direction", array_keys($order), $order));
        }

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function sum($table) {

        $sql = "SELECT Count(*) as count FROM manhwa.$table";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public function search(string $table, string $text) {

        $sql = "SELECT * FROM manhwa.$table WHERE name LIKE '%$text%'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function categorySearch(string $table, int $id) {

        $sql = "SELECT * FROM manhwa.$table WHERE category_id = $id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete(string $table, array $conditions = []): void
    {
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "DELETE FROM manhwa.$table $where";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);
    }

    public function update(string $table, array $data, array $conditions = []): void
    {
        $fields = array_keys($data);

        $set = implode(', ', array_map(fn ($field) => "$field = :$field", $fields));

        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "UPDATE manhwa.$table SET $set $where";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(array_merge($data, $conditions));
    }

    
    private function connect(): void
    {

        $driver = 'mysql';
        $host = 'localhost';
        $database = 'manhwa';
        $charset = 'utf8';
        $username = 'root';
        $password = '';
        
        try{
            $this->pdo = new \PDO( 
                "$driver:host=$host;database=$database;charset=$charset",
                $username, $password
            );
        } catch (\PDOException $i) {
            die('Ошибка подключения к базе данных');
        }
    }
} 