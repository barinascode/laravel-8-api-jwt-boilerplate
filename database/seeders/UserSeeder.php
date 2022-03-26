<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        /*
            Uncomment this code to create admin admin account
        */
        // User::create([
        //     "name" => 'Jhon Doe',
        //     "email" => 'your_admin_email',
        //     "password" => Hash::make('youradminpassword')
        // ]);

    }
}
