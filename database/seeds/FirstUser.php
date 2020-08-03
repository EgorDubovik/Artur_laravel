<?php

use Illuminate\Database\Seeder;

class FirstUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("users")->insert([
        	'email'=>'posik.web.m@gmail.com',
        	'phone_number'=>'7542264666',
            'first_name'=>'Egor',
            'last_name'=>'Dubovik',
        ]);
    }
}
