<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::findOrFail(1)->roles()->sync(1);
        User::findOrFail(2)->roles()->sync(2);
        User::findOrFail(3)->roles()->sync(3);
        User::findOrFail(4)->roles()->sync(3);
        User::findOrFail(5)->roles()->sync(3);
        User::findOrFail(6)->roles()->sync(3);
        User::findOrFail(7)->roles()->sync(3);
        User::findOrFail(8)->roles()->sync(3);
        User::findOrFail(9)->roles()->sync(3);
        User::findOrFail(10)->roles()->sync(3);
        User::findOrFail(11)->roles()->sync(3);
    }
}