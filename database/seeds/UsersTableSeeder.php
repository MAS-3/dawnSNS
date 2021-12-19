<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ダミーユーザー
        DB::table('users')->insert([
                'username' => 'test1',
                'mail' => 'test1'.'@gmail.com',
                'password' => bcrypt('test'),
                'bio' => 'test'
            ],[
                'username' => 'test2',
                'mail' => 'test2'.'@gmail.com',
                'password' => bcrypt('test'),
                'bio' => 'test2'
            ],[
                'username' => 'test3',
                'mail' => 'test3'.'@gmail.com',
                'password' => bcrypt('test'),
                'bio' => 'test3'
            ]
        );
    }
}
