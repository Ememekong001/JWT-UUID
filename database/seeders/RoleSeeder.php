<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrator'
        ]);

        DB::table('roles')->insert([
            'name' => 'Doctor'
        ]);

        DB::table('roles')->insert([
            'name' => 'Nurse'
        ]);

        DB::table('roles')->insert([
            'name' => 'Pharmacist'
        ]);

        DB::table('roles')->insert([
            'name' => 'Receptionist'
        ]);

        DB::table('roles')->insert([
            'name' => 'StudentDoctor'
        ]);

        DB::table('roles')->insert([
            'name' => 'User'
        ]);



    }
}
