<?php

use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        DB::table('users')->insert([
            'name' => 'Waleed Raza',
            'email' => 'admin@digitizingplace.com',
            'password' => bcrypt('password'),
            'role_id'=>1
        ]);


        DB::table('roles')->insert([
            'name' => 'Admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'Client'
        ]);
    }
}
