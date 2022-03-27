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

        User::create([
            "name" => 'Leonardo Tapia',
            "email" => 'admin@yourdomain.ltd',
            'phone_local' => "+581111234567",
            'phone_movil' => "",
            'address' => "Catacombs",
            'super_admin' => true,
            'can_login' => true,
            "password" => Hash::make('youradminpassword')
        ]);
    }
}
