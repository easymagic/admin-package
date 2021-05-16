<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory(1)->create();
//        Company::factory(1)->create();
//        Branch::factory(1)->create();
//
//        $admin = User::getSystemAdmin()->first();
//        $company = Company::getSystemCompany()->first();
//        $branch = Branch::getSystemBranch()->first();
//
//
//        $admin->company_id = $company->id;
//        $admin->save();
//
//        $company->user_id = $admin->id;
//        $company->save();
//
//        $branch->company_id = $company->id;
//        $branch->save();

    }
}
