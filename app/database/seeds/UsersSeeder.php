<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * add first user
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name'=>'ادمین سایت',
            'email'=>'admin@admin.com',
            'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),
            'api_token'=>md5(\Illuminate\Support\Facades\Hash::make('12345678')),
            'is_active'=>'1',
            'avatar_url'=>'assets/images/icon/support.png',
            'mobile'=>'09111111111',
            ]);



    }
}
