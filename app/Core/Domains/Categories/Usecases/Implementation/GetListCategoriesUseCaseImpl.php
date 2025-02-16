<?php

namespace App\Core\Domains\Categories\Usecases\Implementation;

use App\Core\Domains\Categories\Repository\CategoriesRepository;
use App\Core\Domains\Categories\Usecases\GetListCategoriesUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;


class GetListCategoriesUseCaseImpl implements GetListCategoriesUseCase
{
    protected $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function execute(BaseListParams $params): BaseListResponse | BaseException
    {
        try {
            return $this->categoriesRepository->getAllCategories($params);
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
