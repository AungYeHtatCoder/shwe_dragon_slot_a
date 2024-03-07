<?php

namespace Database\Seeders;

use App\Models\Admin\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
              
                'title'      => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
            
                'title'      => 'Master',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
            
                'title'      => 'Agent',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title'      => 'Player',
                'created_at' => now(),
                'updated_at' => now(),
            ]
 
            
        ];

        Role::insert($roles);
    }
}