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
        DB::table('users')->insert([
            'id' => str_replace('-', '', Str::uuid()),
            'firstname' => 'Thai',
            'lastname' => 'Khuong',
            'email' => 'pathoftruth1097@gmail.com',
            'birthday' => '1997-10-14',
            'phone' => '0792168523',
            'password' => bcrypt('123456'),
            'status' => '10',
            'created_at' => '2019-09-04 09:25:20',
            'updated_at' => '2019-09-04 09:25:20',
        ]);
    }
}
