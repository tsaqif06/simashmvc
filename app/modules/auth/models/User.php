<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $table = 'users';

    public function authenticate($username, $password): ?array
    {
        return $this->getQueryBuilder()
            ->from($this->table)
            ->where('username', $username)
            ->where('password', md5($password)) // Use bcrypt or similar hashing in production
            ->fetch();
    }

    public function create(array $data): void
    {
        // Ensure password is hashed before storing
        $data['password'] = md5($data['password']); // Use bcrypt or similar hashing in production
        $this->getQueryBuilder()->insertInto($this->table)->values($data)->execute();
    }

    public function update(int $id, array $data): void
    {
        // Ensure password is hashed if it is being updated
        if (isset($data['password'])) {
            $data['password'] = md5($data['password']); // Use bcrypt or similar hashing in production
        }
        $this->getQueryBuilder()->update($this->table)->set($data)->where('id', $id)->execute();
    }

    public function delete(int $id): void
    {
        $this->getQueryBuilder()->deleteFrom($this->table)->where('id', $id)->execute();
    }
}
