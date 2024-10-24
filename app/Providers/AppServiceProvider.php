<?php

namespace App\Providers;

use App\Events\IsRegistered;
use App\Listeners\SendWelcomeEmail;
use App\Repositories\Interface\{
    ContactRepositoryInterface,
    ClientRepositoryInterface,
    CommentRepositoryInterface,
    OfferRepositoryInterface,
    NotificationRepositoryInterface,
    OrderRepositoryInterface,
    ProductRepositoryInterface,
    RestaurantRepositoryInterface, RoleRepositoryInterface};

use App\Repositories\SQL\{
    ClientRepository,
    CommentRepository,
    ProductRepository,
    ContactRepository,
    NotificationRepository,
    OfferRepository,
    OrderRepository,
    RestaurantRepository, RoleRepository, };
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(ClientRepositoryInterface::class,ClientRepository::class);
        // $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        // $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
        // $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);
        // $this->app->bind(RestaurantRepositoryInterface::class,RestaurantRepository::class);
        // $this->app->bind(NotificationRepositoryInterface::class,NotificationRepository::class);
        // $this->app->bind(ContactRepositoryInterface::class,ContactRepository::class);
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Event::listen(
        //     IsRegistered::class,
        //     SendWelcomeEmail::class,
        // );
    }
}
