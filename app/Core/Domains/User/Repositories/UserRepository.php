<?php

namespace App\Core\Domains\User\Repositories;

use App\Core\Domains\User\Repositories\Model\UserModel;
use App\Core\Domains\User\Entities\UserEntities;

interface UserRepositoryInterface
{
    public function createEmployee(array $data): ?UserEntities;

    public function hashPassword(string $password): string;

    public function getAllEmployees(int $limit, int $offset): array;

    public function countEmployees(): int;

    public function deleteEmployee(int $userId): bool;
}

class UserRepository implements UserRepositoryInterface
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function createEmployee(array $data): ?UserEntities
    {
        $data['role_id'] = 2;

        $this->userModel->insert($data);

        return new UserEntities($data);
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getAllEmployees(int $limit, int $offset): array
    {
        $employees = $this->userModel->getEmployees($limit, $offset);

        return array_map(function ($employee) {
            return new UserEntities($employee);
        }, $employees);
    }

    public function countEmployees(): int
    {
        return $this->userModel->countEmployees();
    }

    public function deleteEmployee(int $userId): bool
    {
        return $this->userModel->deleteEmployee($userId);
    }
}