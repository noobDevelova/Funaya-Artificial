<?php

namespace App\Core\Domains\User\Usecases;

use App\Core\Domains\User\Repositories\UserRepository;

class GetListEmployeesUseCase
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $limit, int $page)
    {
        $offset = ($page - 1) * $limit;

        $employees = $this->userRepository->getAllEmployees($limit, $offset);

        $totalEmployees = $this->userRepository->countEmployees();

        $totalPages = ceil($totalEmployees / $limit);

        return [
            'employees' => $employees,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'totalEmployees' => $totalEmployees,
        ];
    }
}
