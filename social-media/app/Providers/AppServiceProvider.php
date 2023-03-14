<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Dao Registeration
        $this->app->bind('App\Contract\Dao\User\UserDaoInterface', 'App\Dao\User\UserDao');
        $this->app->bind('App\Contract\Dao\Admin\AdminDaoInterface', 'App\Dao\Admin\AdminDao');

        //Business Logic Registeration
        $this->app->bind('App\Contract\Service\User\UserServiceInterface', 'App\Service\User\UserService');
        $this->app->bind('App\Contract\Service\Admin\AdminServiceInterface', 'App\Service\Admin\AdminService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
