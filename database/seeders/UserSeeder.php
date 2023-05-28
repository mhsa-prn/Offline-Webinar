<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            ['name'=>'Tabesh','password'=>'1234','email'=>'tabesh@gmail.com','email_verified_at'=>Carbon::now(),'created_at'=>Carbon::now()],
            ['name'=>'Reza','password'=>'1234','email'=>'reza@gmail.com','email_verified_at'=>Carbon::now(),'created_at'=>Carbon::now()],
            ['name'=>'Mahsa','password'=>'1234','email'=>'mahsa@gmail.com','email_verified_at'=>Carbon::now(),'created_at'=>Carbon::now()],
            ['name'=>'Mohamadreza','password'=>'1234','email'=>'mr@gmail.com','email_verified_at'=>Carbon::now(),'created_at'=>Carbon::now()],
        ];
        DB::table('users')->insert($users);
    }
}
