<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # esto no esta en el generado por el instalador pero lo dejare para ver que pedo
        Model::unguard();

        $this->call([
            UsersTableSeeder::class
        ]);

        Model::reguard();
    }
}
