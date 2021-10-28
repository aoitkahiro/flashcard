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
        $datum = [
            ['name' => 'Test1','email' => 'test1@mail.com','password' => Hash::make('test1234')],
            ['name' => 'Test2','email' => 'test2@mail.com','password' => Hash::make('test1234')],
        ];
        DB::table('users')->insert($datum);
    }
}
