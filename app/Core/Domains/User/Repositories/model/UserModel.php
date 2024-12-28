<?php

namespace App\Core\Domains\User\Repositories\Model;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role_id',
        'phone_number',
        'last_login',
        'created_at',
        'updated_at'
    ];

    public function getEmployees(int $limit, int $offset): array
    {
        return $this->where('role_id', 2)->limit($limit, $offset)->findAll();
    }

    public function countEmployees(): int
    {
        return $this->where('role_id', 2)->countAllResults();
    }

    public function deleteEmployee(int $userId)
    {
        $employee = $this->where('id', $userId)->where('role_id', 2)->first();

        if (!$employee) {
            throw new \Exception("Employee not found or unauthorized deletion.");
        }

        return $this->delete($userId);
    }
}