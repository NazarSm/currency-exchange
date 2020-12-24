<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    const PASSWORD = 'admin';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => User::ROLE_ADMIN,
            'balance' => 12345,
            'password' => password_hash(self::PASSWORD, PASSWORD_DEFAULT)
        ];
        DB::table('users')->insert($admin);
    }
}
