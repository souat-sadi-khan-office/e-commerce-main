<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\CartRepository;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\LocationRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\LocationRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\PcBuilderRepository;
use App\Repositories\GatewayConfigurationRepository;
use App\Repositories\ProductSpecificationRepository;
use App\Repositories\Interface\AuthRepositoryInterface;
use App\Repositories\Interface\CartRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\PaymentRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\CurrencyRepositoryInterface;
use App\Repositories\Interface\LocationRepositoryInterface;
use App\Repositories\Interface\DashBoardRepositoryInterface;
use App\Repositories\Interface\PcBuilderRepositoryInterface;
use App\Repositories\Interface\GatewayConfigurationRepositoryInterface;
use App\Repositories\Interface\ProductSpecificationRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(DashBoardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(GatewayConfigurationRepositoryInterface::class, GatewayConfigurationRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(PcBuilderRepositoryInterface::class, PcBuilderRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductSpecificationRepositoryInterface::class, ProductSpecificationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}