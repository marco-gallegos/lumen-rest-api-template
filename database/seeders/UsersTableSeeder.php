<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Administrador",
            'email' => "admin@admin.com.mx",
            'password' => app('hash')->make("admin12345"),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
