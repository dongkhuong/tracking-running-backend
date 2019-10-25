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
            'firstname' => 'Hung',
            'lastname' => 'Vo',
            'email' => 'hungvt.itdng@gmail.com',
            'birthday' => '1988-06-25',
            'phone' => '0905747606',
            'password' => bcrypt('123123'),
            'status' => '10',
            'created_at' => '2019-09-04 09:25:20',
            'updated_at' => '2019-09-04 09:25:20',
        ]);
    }
}
