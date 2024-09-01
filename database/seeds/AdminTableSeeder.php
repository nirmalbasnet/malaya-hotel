<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BackendModel\Admin::create([
            'name' => 'Nirmal Basnet',
            'username' => 'nirmalbasnet',
            'email' => 'nirmal@gmail.com',
            'password' => bcrypt('nirmal@123'),
        ]);
    }
}
