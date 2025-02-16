<?php

namespace Config;

use App\Core\Domains\Auth\DTOs\AuthDTOFactory;
use App\Core\Domains\Auth\DTOs\Implementation\AuthDTOFactoryImpl;
use App\Core\Domains\Auth\Repositories\Implementation\AuthRepositoryImpl;
use App\Core\Domains\Categories\DTOs\Implementation\CategoriesDTOFactoryImpl;
use App\Core\Domains\Purchases\Repository\Implementation\PurchasesRepositoryImpl;
use App\Core\Domains\Purchases\Repository\Model\PurchaseItemsModel;
use App\Core\Domains\Purchases\Usecases\PurchasesUsecases;
use App\Core\Domains\Sales\DTOs\Implementation\SalesDTOFactoryImpl;
use App\Core\Domains\Sales\Repository\Implementation\SalesRepositoryImpl;
use App\Core\Domains\Sales\Repository\Model\SalesModel;
use App\Core\Domains\Supplier\DTOs\Implementation\SupplierDTOFactoryImpl;
use App\Core\Domains\Supplier\Repository\Implementation\SupplierRepositoryImpl;
use App\Core\Domains\Categories\Repository\Implementation\CategoriesRepositoryImpl;
use App\Core\Domains\Auth\Repositories\AuthRepository;
use App\Core\Domains\Supplier\Repository\SupplierRepository;
use App\Core\Domains\Supplier\Usecases\CreateSupplierUseCase;
use App\Core\Domains\Supplier\Usecases\GetSupplierUseCase;
use App\Core\Domains\Categories\Repository\CategoriesRepository;
use App\Core\Domains\Categories\Usecases\CreateCategoriesUseCase;
use App\Core\Domains\Categories\Usecases\DeleteCategoriesUseCase;
use App\Core\Domains\Categories\Usecases\GetCategoriesUseCase;
use App\Core\Domains\Categories\Usecases\GetListCategoriesUseCase;
use App\Core\Domains\Categories\Usecases\UpdateCategoriesUseCase;
use App\Core\Domains\Auth\Usecases\AuthenticateUserUseCase;
use App\Core\Domains\Auth\Usecases\UnAuthenticateUserUseCase;
use App\Core\Domains\Auth\Usecases\AuthUsecases;
use App\Core\Domains\Auth\Repositories\Model\AuthModel;
use App\Core\Domains\User\Repositories\Model\UserModel;
use App\Core\Domains\User\Repositories\Model\RolesModel;
use App\Core\Domains\Supplier\Repository\Model\SupplierModel;
use App\Core\Domains\Categories\Repository\Model\CategoriesModel;
use App\Core\Domains\Products\Repository\Model\ProductModel;
use App\Core\Domains\Categories\DTOs\CategoriesDTOFactory;
use App\Core\Domains\Categories\Usecases\CategoriesUsecases;
use App\Core\Domains\Inventory\Model\InventoryModel;
use App\Core\Domains\Products\DTOs\Implementation\ProductDTOFactoryImpl;
use App\Core\Domains\Products\DTOs\ProductDTOFactory;
use App\Core\Domains\Products\Repository\Implementation\ProductRepositoryImpl;
use App\Core\Domains\Products\Repository\Model\ProductDetailModel;
use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Domains\Products\Usecases\CreateProductUseCase;
use App\Core\Domains\Products\Usecases\DeleteProductUseCase;
use App\Core\Domains\Products\Usecases\GetListProductsUseCase;
use App\Core\Domains\Products\Usecases\GetProductUseCase;
use App\Core\Domains\Products\Usecases\ProductUsecases;
use App\Core\Domains\Products\Usecases\ToggleShowOnCatalogProductUseCase;
use App\Core\Domains\Products\Usecases\UpdateProductUseCase;
use App\Core\Domains\Purchases\DTOs\Implementation\PurchasesDTOFactoryImpl;
use App\Core\Domains\Purchases\DTOs\PurchasesDTOFactory;
use App\Core\Domains\Purchases\Repository\Model\PurchasesModel;
use App\Core\Domains\Purchases\Repository\PurchasesRepository;
use App\Core\Domains\Purchases\Usecases\CreatePurchaseUseCase;
use App\Core\Domains\Purchases\Usecases\GetListPurchasesUseCase;
use App\Core\Domains\Sales\DTOs\SalesDTOFactory;
use App\Core\Domains\Sales\Repository\Model\SalesItemsModel;
use App\Core\Domains\Sales\Repository\SalesRepository;
use App\Core\Domains\Sales\Usecases\CreateSalesReportUseCase;
use App\Core\Domains\Sales\Usecases\GetSalesReportsUseCase;
use App\Core\Domains\Sales\Usecases\SaleUsecases;
use App\Core\Domains\Supplier\DTOs\SupplierDTOFactory;
use App\Core\Domains\Supplier\Usecases\DeleteSupplierUseCase;
use App\Core\Domains\Supplier\Usecases\GetListSupplierUseCase;
use App\Core\Domains\Supplier\Usecases\SupplierUsecases;
use App\Core\Domains\Supplier\Usecases\UpdateSupplierUseCase;
use App\Core\Domains\User\DTOs\Implementation\UserDTOFactoryImpl;
use App\Core\Domains\User\DTOs\UserDTOFactory;
use App\Core\Domains\User\Repositories\Implementation\UserRepositoryImpl;
use App\Core\Domains\User\Usecases\CreateUserUseCase;
use App\Core\Domains\User\Usecases\DeleteUserUseCase;
use App\Core\Domains\User\Usecases\GetListRolesUseCase;
use App\Core\Domains\User\Usecases\GetListUsersUseCase;
use App\Core\Domains\User\Usecases\GetUserUseCase;
use App\Core\Domains\User\Usecases\UpdateUserUseCase;
use App\Core\Domains\User\Usecases\ToggleActiveUserUseCase;
use App\Core\Domains\User\Usecases\UserUsecases;
use App\Infrastructure\FileServices;
use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    // DTO Factories
    public static function authDTOFactory(bool $getShared = true): AuthDTOFactory
    {
        return $getShared ? static::getSharedInstance('authDTOFactory') : new AuthDTOFactoryImpl();
    }

    public static function categoriesDTOfactory(bool $getShared = true): CategoriesDTOFactory
    {
        return $getShared ? static::getSharedInstance('categoriesDTOfactory') : new CategoriesDTOFactoryImpl();
    }

    public static function supplierDTOFactory(bool $getShared = true): SupplierDTOFactory
    {
        return $getShared ? static::getSharedInstance('supplierDTOFactory') : new SupplierDTOFactoryImpl();
    }

    public static function userDTOFactory(bool $getShared = true): UserDTOFactory
    {
        return $getShared ? static::getSharedInstance('userDTOFactory') : new UserDTOFactoryImpl();
    }

    public static function productDTOFactory(bool $getShared = true): ProductDTOFactory
    {
        return $getShared ? static::getSharedInstance('productDTOFactory') : new ProductDTOFactoryImpl();
    }

    public static function purchasesDTOFactory(bool $getShared = true): PurchasesDTOFactory
    {
        return $getShared ? static::getSharedInstance('purchasesDTOFactory') : new PurchasesDTOFactoryImpl();
    }

    public static function salesDTOFactory(bool $getShared = true): SalesDTOFactory
    {
        return $getShared ? static::getSharedInstance('salesDTOFactory') : new SalesDTOFactoryImpl();
    }

    // Repository
    public static function authRepository(bool $getShared = true): AuthRepository
    {
        $authModel = new AuthModel();
        $authDTOFactory = service('authDTOFactory');

        return $getShared ? static::getSharedInstance('authRepository') : new AuthRepositoryImpl(
            $authModel,
            $authDTOFactory
        );
    }

    public static function userRepository(bool $getShared = true): UserRepository
    {
        $userModel = new UserModel();
        $rolesModel = new RolesModel();
        $userDTOFactory = service('userDTOFactory');

        return $getShared ? static::getSharedInstance('userRepository') : new UserRepositoryImpl(
            $userModel,
            $rolesModel,
            $userDTOFactory
        );
    }

    public static function supplierRepository(bool $getShared = true): SupplierRepository
    {
        $supplierModel = new SupplierModel();
        $supplierDTOFactory = service('supplierDTOFactory');

        return $getShared ? static::getSharedInstance('supplierRepository') : new SupplierRepositoryImpl(
            $supplierModel,
            $supplierDTOFactory
        );
    }

    public static function categoriesRepository($getShared = true): CategoriesRepository
    {
        $categoriesModel = new CategoriesModel();
        $categoriesDTOFactory = service('categoriesDTOfactory');

        return $getShared ? static::getSharedInstance('categoriesRepository') : new CategoriesRepositoryImpl(
            $categoriesModel,
            $categoriesDTOFactory
        );
    }

    public static function productRepository(bool $getShared = true): ProductRepository
    {
        $productModel = new ProductModel();
        $productDetailModel = new ProductDetailModel();
        $productDTOFactory = service('productDTOFactory');
        $fileService = new FileServices();

        return $getShared ? static::getSharedInstance('productRepository') : new ProductRepositoryImpl(
            $productModel,
            $productDetailModel,
            $productDTOFactory,
            $fileService
        );
    }

    public static function purchasesRepository(bool $getShared = true): PurchasesRepository
    {
        $productModel = new ProductModel();
        $purchasesModel = new PurchasesModel();
        $purchaseItemsModel = new PurchaseItemsModel();
        $inventoryModel = new InventoryModel();
        $purchasesDTOFactory = service('purchasesDTOFactory');

        return $getShared ? static::getSharedInstance('purchasesRepository') : new PurchasesRepositoryImpl(
            $productModel,
            $purchasesModel,
            $purchaseItemsModel,
            $inventoryModel,
            $purchasesDTOFactory
        );
    }

    public static function salesRepository(bool $getShared = true): SalesRepository
    {
        $salesModel = new SalesModel();
        $salesItemsModel = new SalesItemsModel();
        $productModel = new ProductModel();
        $salesDTOFactory = service('salesDTOFactory');

        return $getShared ? static::getSharedInstance('salesRepository') : new SalesRepositoryImpl(
            $salesModel,
            $salesItemsModel,
            $productModel,
            $salesDTOFactory
        );
    }

    // Usecases
    public static function authenticateUserUseCase($getShared = true): AuthenticateUserUseCase
    {
        $authRepositoryService = service('authRepository');

        return $getShared ? static::getSharedInstance('authenticateUserUseCase') : AuthUsecases::createAuth($authRepositoryService);
    }

    public static function unAuthenticateUserUseCase($getShared = true): UnAuthenticateUserUseCase
    {
        $authRepositoryService = service('authRepository');

        return $getShared ? static::getSharedInstance('unAuthenticateUserUseCase') : AuthUsecases::deleteAuth($authRepositoryService);
    }

    public static function getListUsersUseCase(bool $getShared = true): GetListUsersUseCase
    {
        $userRepositoryService = service('userRepository');

        return $getShared ? static::getSharedInstance('getListUsersUseCase') : UserUsecases::getListUsers($userRepositoryService);
    }

    public static function getListRolesUseCase(bool $getShared = true): GetListRolesUseCase
    {
        $userRepositoryService = service('userRepository');

        return $getShared ? static::getSharedInstance('getListRolesUseCase') : UserUsecases::getListRoles($userRepositoryService);
    }

    public static function createUserUseCase(bool $getShared = true): CreateUserUseCase
    {
        $userRepositoryService = service('userRepository');

        return $getShared ? static::getSharedInstance('createUserUseCase') : UserUsecases::createUser($userRepositoryService);
    }

    public static function getUserUseCase(bool $getShared = true): GetUserUseCase
    {
        $userRepositoryService = service('userRepository');

        return $getShared ? static::getSharedInstance('getUserUseCase') : UserUsecases::getUser($userRepositoryService);
    }

    public static function updateUserUseCase(bool $getShared = true): UpdateUserUseCase
    {
        $userRepositoryService = service('userRepository');

        return $getShared ? static::getSharedInstance('updateUserUseCase') : UserUsecases::updateUser($userRepositoryService);
    }

    public static function toggleActiveUserUseCase(bool $getShared = true): ToggleActiveUserUseCase
    {
        $userRepositoryService = service('userRepository');

        return $getShared ? static::getSharedInstance('toggleActiveUserUseCase') : UserUsecases::toggleActiveUser($userRepositoryService);
    }

    public static function deleteUserUseCase(bool $getShared = true): DeleteUserUseCase
    {
        $userRepositoryService = service('userRepository');

        return $getShared ? static::getSharedInstance('deleteUserUseCase') : UserUsecases::deleteUser($userRepositoryService);
    }

    public static function getListCategoriesUseCase($getShared = true): GetListCategoriesUseCase
    {
        $categoriesRepositoryService = service('categoriesRepository');

        return $getShared ? static::getSharedInstance('getListCategoriesUseCase') : CategoriesUsecases::getList($categoriesRepositoryService);
    }

    public static function createCategoriesUseCase($getShared = true): CreateCategoriesUseCase
    {
        $categoriesRepositoryService = service('categoriesRepository');

        return $getShared ? static::getSharedInstance('createCategoriesUseCase') : CategoriesUsecases::create($categoriesRepositoryService);
    }

    public static function getCategoriesUseCase($getShared = true): GetCategoriesUseCase
    {
        $categoriesRepositoryService = service('categoriesRepository');

        return $getShared ? static::getSharedInstance('getCategoriesUseCase') : CategoriesUsecases::getSingle($categoriesRepositoryService);
    }

    public static function updateCategoriesUseCase($getShared = true): UpdateCategoriesUseCase
    {
        $categoriesRepositoryService = service('categoriesRepository');

        return $getShared ?  static::getSharedInstance('updateCategoriesUseCase') : CategoriesUsecases::update($categoriesRepositoryService);
    }

    public static function deleteCategoriesUseCase(bool $getShared = true): DeleteCategoriesUseCase
    {
        $categoriesRepositoryService = service('categoriesRepository');

        return $getShared ? static::getSharedInstance('deleteCategoriesUseCase') : CategoriesUsecases::delete($categoriesRepositoryService);
    }

    public static function getListSupplierUseCase(bool $getShared = true): GetListSupplierUseCase
    {
        $supplierRepositoryService = service('supplierRepository');

        return $getShared ? static::getSharedInstance('getListSupplierUseCase') : SupplierUsecases::getList($supplierRepositoryService);
    }

    public static function createSupplierUseCase(bool $getShared = true): CreateSupplierUseCase
    {
        $supplierRepositoryService = service('supplierRepository');

        return $getShared ? static::getSharedInstance('createSupplierUseCase') : SupplierUsecases::create($supplierRepositoryService);
    }

    public static function getSupplierUseCase(bool $getShared = true): GetSupplierUseCase
    {
        $supplierRepositoryService = service('supplierRepository');

        return $getShared ? static::getSharedInstance('getSupplierUseCase') : SupplierUsecases::getSingle($supplierRepositoryService);
    }

    public static function updateSupplierUseCase(bool $getShared = true): UpdateSupplierUseCase
    {
        $supplierRepositoryService = service('supplierRepository');

        return $getShared ? static::getSharedInstance('updateSupplierUseCase') : SupplierUsecases::update($supplierRepositoryService);
    }

    public static function deleteSupplierUseCase(bool $getShared = true): DeleteSupplierUseCase
    {
        $supplierRepositoryService = service('supplierRepository');

        return $getShared ? static::getSharedInstance('deleteSupplierUseCase') : SupplierUsecases::delete($supplierRepositoryService);
    }

    public static function createProductUseCase(bool $getShared = true): CreateProductUseCase
    {
        $productRepositoryService = service('productRepository');

        return $getShared ? static::getSharedInstance('createProductUseCase') : ProductUsecases::createProduct($productRepositoryService);
    }

    public static function getListProductUseCase(bool $getShared = true): GetListProductsUseCase
    {
        $productRepositoryService = service('productRepository');

        return $getShared ? static::getSharedInstance('getListProductUseCase') : ProductUsecases::getList($productRepositoryService);
    }

    public static function getProductUseCase(bool $getShared = true): GetProductUseCase
    {
        $productRepositoryService = service('productRepository');

        return $getShared ? static::getSharedInstance('getProductUseCase') : ProductUsecases::getProduct($productRepositoryService);
    }

    public static function updateProductUseCase(bool $getShared = true): UpdateProductUseCase
    {
        $productRepositoryService = service('productRepository');

        return $getShared ? static::getSharedInstance('updateProductUseCase') : ProductUsecases::updateProduct($productRepositoryService);
    }

    public static function getListProductsKeyUseCase(bool $getShared = true)
    {
        $productRepositoryService = service('productRepository');

        return $getShared ? static::getSharedInstance('getListProductsKeyUseCase') : ProductUsecases::getKey($productRepositoryService);
    }

    public static function deleteProductUseCase(bool $getShared = true): DeleteProductUseCase
    {
        $productRepositoryService = service('productRepository');

        return $getShared ? static::getSharedInstance('deleteProductUseCase') : ProductUsecases::deleteProduct($productRepositoryService);
    }

    public static function toggleShowOnCatalogProductUseCase(bool $getShared = true): ToggleShowOnCatalogProductUseCase
    {
        $productRepositoryService = service('productRepository');

        return $getShared ? static::getSharedInstance('toggleShowOnCatalogProductUseCase') : ProductUsecases::toggleShowOnCatalog($productRepositoryService);
    }

    public static function createPurchaseUseCase(bool $getShared = true): CreatePurchaseUseCase
    {
        $purchasesRepositoryService = service('purchasesRepository');

        return $getShared ? static::getSharedInstance('createPurchaseUseCase') : PurchasesUsecases::createPurchase($purchasesRepositoryService);
    }

    public static function getListPurchasesUseCase(bool $getShared = true): GetListPurchasesUseCase
    {
        $purchasesRepositoryService = service('purchasesRepository');

        return $getShared ? static::getSharedInstance('getListPurchasesUseCase') : PurchasesUsecases::getListPurchases($purchasesRepositoryService);
    }

    public static function createSalesReportUseCase(bool $getShared = true): CreateSalesReportUseCase
    {
        $salesRepositoryService = service('salesRepository');

        return $getShared ? static::getSharedInstance('createSalesReportUseCase') : SaleUsecases::createReport($salesRepositoryService);
    }

    public static function getSalesReportsUseCase(bool $getShared = true): GetSalesReportsUseCase
    {
        $salesRepositoryService = service('salesRepository');

        return $getShared ? static::getSharedInstance('getSalesReportsUseCase') : SaleUsecases::getReports($salesRepositoryService);
    }
}
