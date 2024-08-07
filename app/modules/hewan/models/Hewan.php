<?php

namespace App\Models;

use Core\Model;

class Hewan extends Model
{
    protected $table = 'hewan';

    public function getAll(): array
    {
        return $this->getQueryBuilder()->from($this->table)->fetchAll();
    }

    public function findById(int $id): ?array
    {
        return $this->getQueryBuilder()->from($this->table)->where('id', $id)->fetch();
    }

    public function create(array $data): void
    {
        $this->getQueryBuilder()->insertInto($this->table)->values($data)->execute();
    }

    public function update(int $id, array $data): void
    {
        $this->getQueryBuilder()->update($this->table)->set($data)->where('id', $id)->execute();
    }

    public function delete(int $id): void
    {
        $this->getQueryBuilder()->deleteFrom($this->table)->where('id', $id)->execute();
    }
}
