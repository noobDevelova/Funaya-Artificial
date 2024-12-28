<?php

namespace App\Core\Domains\User\Usecases;

use App\Core\Domains\User\Repositories\UserRepository;

class DeleteEmployeeUseCase
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $userId)
    {
        try {
            $result = $this->userRepository->deleteEmployee($userId);

            if (!$result) {
                throw new \Exception("Failed to delete employee.");
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
