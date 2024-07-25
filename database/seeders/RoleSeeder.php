<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name_role' => 'utilisateur',
            'description_role' => 'administateur'
        ]);
        Role::create([
            'name_role' => 'administateur',
            'description_role' => 'administateur'
        ]);
    }
}
