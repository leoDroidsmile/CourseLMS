<?php

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
//     $this->call(UserSeeder::class);
//        $this->call(OrganizationSeeder::class);
//        $this->call(LanguageSeeder::class);
//        $this->call(CurrencySeeder::class);
        $this->call(SubscriptionSeeder::class);
    }
}
