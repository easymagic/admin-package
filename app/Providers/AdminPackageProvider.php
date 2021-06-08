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

           __DIR__ . '/../../resources/views/response-message.blade.php'=>base_path('resources/views/response-message.blade.php'),

           __DIR__ . '/../../resources/views/js_cdns'=>base_path('resources/views/js_cdns'),

           __DIR__ . '/../../resources/views/auth'=>base_path('resources/views/auth'),

           __DIR__ . '/../../resources/views/admin-user'=>base_path('resources/views/admin-user'),
           __DIR__ . '/../../resources/views/company'=>base_path('resources/views/company'),

           __DIR__ . '/../../app/Models/User.php'=>base_path('app/Models/User.php'),
           __DIR__ . '/../../app/Models/Company.php'=>base_path('app/Models/Company.php'),

           __DIR__ . '/../../app/Traits'=>base_path('app/Traits'),

           __DIR__ . '/../../database/factories/UserFactory.php'=>base_path('database/factories/UserFactory.php'),
//           __DIR__ . '/../../database/factories/CompanyFactory.php'=>base_path('database/factories/CompanyFactory.php'),


           ///theme directory
           __DIR__ . '/../../public/admin-theme'=>base_path('public/admin-theme'),


           ///routes
           __DIR__ . '/../../routes'=>base_path('routes/admin-routes'),

           //Migrations
           __DIR__ . '/../../database/migrations/2014_10_12_000000_create_users_table.php'=>base_path('database/migrations/2014_10_12_000000_create_users_table.php'),
           __DIR__ . '/../../database/migrations/2021_05_22_085835_create_companies_table.php'=>base_path('database/migrations/2021_05_22_085835_create_companies_table.php'),

           __DIR__ . '/../../app/Services'=>base_path('app/Services/'),

           __DIR__ . '/../../app/Http/Controllers/UserController.php'=>base_path('app/Http/Controllers/UserController.php'),
           __DIR__ . '/../../app/Http/Controllers/CompanyController.php'=>base_path('app/Http/Controllers/CompanyController.php'),

           __DIR__ . '/../../app/Console/Commands/InitAdminPackage.php'=>base_path('app/Console/Commands/InitAdminPackage.php')


       ]);



    }




}
