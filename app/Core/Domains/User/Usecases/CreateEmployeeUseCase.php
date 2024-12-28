<?php

namespace App\Core\Domains\User\Usecases;

use App\Core\Domains\User\DTOs\CreateUserRequest;
use App\Core\Domains\User\Entities\UserEntities;
use App\Core\Domains\User\Repositories\UserRepository;
use Exception;

class CreateEmployeeUseCase
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $createUserRequest): UserEntities
    {
        $this->validateData($createUserRequest);

        $data = [
            'username' => $createUserRequest->username,
            'email' => $createUserRequest->email,
            'password' => $this->userRepository->hashPassword($createUserRequest->password),
            'phone_number' => $createUserRequest->phone_number,
        ];

        $employee = $this->userRepository->createEmployee($data);

        if (!$employee) {
            throw new Exception('Failed to create employee');
        }

        return $employee;
    }

    private function validateData(CreateUserRequest $createUserRequest)
    {
        if (empty($createUserRequest->username)) {
            throw new Exception('Username is required');
        }

        if (empty($createUserRequest->email)) {
            throw new Exception('Email is required');
        }

        if (empty($createUserRequest->password)) {
            throw new Exception('Password is required');
        }

        if (empty($createUserRequest->phone_number)) {
            throw new Exception('Phone number is required');
        }
    }
}