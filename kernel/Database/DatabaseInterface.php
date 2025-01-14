<?php

namespace App\Kernel\Database;

interface DatabaseInterface
{
    public function insert(string $table, array $data);

    public function first(string $table, array $conditions = []): ?array;

    public function get(string $table, array $conditions = [], array $order = [], int $limit = -1): array;

    public function delete(string $table, array $conditions = []): void;

    public function update(string $table, array $data, array $conditions = []): void;

    public function sum(string $table);

    public function search(string $table, string $text);

    public function categorySearch(string $table, int $id);
}