<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
//use Hash;
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
            'password'=>Hash::make("ilavebspu"),
            'first_name'=>'Egor',
            'last_name'=>'Dubovik',
            'is_admin'=>1,
            'confirmed'=>1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
