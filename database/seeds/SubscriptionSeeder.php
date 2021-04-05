<?php

use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription_settings')->insert([
            'type' => 'enable_instructor_request',
            'value' => 1,
        ]);

        DB::table('subscription_settings')->insert([
            'type' => 'enable_all_course',
            'value' => 0,
        ]);

        DB::table('subscription_settings')->insert([
            'type' => 'enable_free_trial',
            'value' => 1,
        ]);

        DB::table('subscription_settings')->insert([
            'type' => 'payment_schedule',
            'value' => 'Monthly',
        ]);
    }
}
