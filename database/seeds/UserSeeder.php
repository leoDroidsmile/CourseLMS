<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'Admin',
          'email' => 'admin@mail.com',
          'password' => Hash::make('12345678'),
          'user_type' => 'Admin',
          'banned' => false,
          'verified' => true,
          'image' => 'uploads/user/nfkUiXvcdhYfWol7esVLtUxZ0kOqTkvC2FMsYiNa.png',
      ]);
    }
}
