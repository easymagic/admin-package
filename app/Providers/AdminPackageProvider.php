<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminPackageProvider extends ServiceProvider
{
    // App\Providers\AdminPackageProvider
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //


       $this->publishes([

           ///models and resources
           __DIR__ . '/../../resources/views/layouts'=>base_path('resources/views/layouts'),
           __DIR__ . '/../../resources/views/admin-user'=>base_path('resources/views/admin-user'),
           __DIR__ . '/../../app/Models/User.php'=>base_path('app/Models/User.php'),
           __DIR__ . '/../../app/Models/Company.php'=>base_path('app/Models/Company.php'),

           ///theme directory
           __DIR__ . '/../../public/admin-theme'=>base_path('public/admin-theme'),


           ///routes
           __DIR__ . '/../../routes'=>base_path('routes/admin-routes'),



       ]);



    }




}
