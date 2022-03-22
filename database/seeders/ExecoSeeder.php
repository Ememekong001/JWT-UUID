<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Str;


class ExecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminpass'),
            'age' => '52',
            'address'=> '10 Udo Eduok',
            'phone' => '09094502345',
            'role_id' => '1'
        ]);

    //     DB::table('users')->insert([
    //         'name' => 'Doctor',
    //         'email' => 'doctor@gmail.com',
    //         'password' => Hash::make('docotorpass'),
    //         'age' => '25',
    //         'address'=> '10 Udo Eduok',
    //         'phone' => '08089670445',
    //         'role_id' => '2'
    //     ]);

    //     DB::table('users')->insert([
    //         'name' => 'Nurse',
    //         'email' => 'nurse@gmail.com',
    //         'password' => Hash::make('nursepass'),
    //         'age' => '20',
    //         'address'=> '10 Udo Eduok',
    //         'phone' => '09094502345',
    //         'role_id' => '3'
    //     ]);

    //     DB::table('users')->insert([
    //         'name' => 'Pharmacist',
    //         'email' => 'pharm@gmail.com',
    //         'password' => Hash::make('pharmpass'),
    //         'age' => '27',
    //         'address'=> '10 Udo Eduok',
    //         'phone' => '08089670446',
    //         'role_id' => '4'
    //     ]);

    //     DB::table('users')->insert([
    //         'name' => 'Receptionist',
    //         'email' => 'reception@gmail.com',
    //         'password' => Hash::make('adminpass'),
    //         'age' => '25',
    //         'address'=> '10 Udo Eduok',
    //         'phone' => '09094502345',
    //         'role_id' => '5'
    //     ]);

    //     DB::table('users')->insert([
    //         'name' => 'StudentDoctor',
    //         'email' => 'student@gmail.com',
    //         'password' => Hash::make('studentpass'),
    //         'age' => '25',
    //         'address'=> '10 Udo Eduok',
    //         'phone' => '09094502345',
    //         'role_id' => '6'
    //     ]);

    //     DB::table('users')->insert([
    //         'name' => 'User',
    //         'email' => 'user@gmail.com',
    //         'password' => Hash::make('userpass'),
    //         'age' => '25',
    //         'address'=> '10 Udo Eduok',
    //         'phone' => '09094502345',
    //         'role_id' => '7'
    //     ]);
    }
}
