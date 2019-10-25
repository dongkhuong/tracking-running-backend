<?php

use Illuminate\Database\Seeder;
use App\Http\Models\AuthAssignment;
use App\Http\Models\AuthItemChild;

class AuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auth_items')->insert([
            [
                'name' => AuthAssignment::ROLE_SUPER_ADMIN,
                'type' => AuthAssignment::TYPE_ROLE_SUPER_ADMIN
            ],
            [
                'name' => AuthAssignment::ROLE_USER,
                'type' => AuthAssignment::TYPE_ROLE_USER
            ],
            [
                'name' => AuthAssignment::ROLE_GUEST,
                'type' => AuthAssignment::TYPE_ROLE_GUEST
            ],
            [
                'name' => AuthAssignment::PERMISSION_GUEST,
                'type' => AuthAssignment::TYPE_PERMISSION
            ],
            [
                'name' => AuthAssignment::PERMISSION_USER,
                'type' => AuthAssignment::TYPE_PERMISSION
            ],
        ]);

        DB::table('auth_item_childs')->insert([
            [
                'parent' => AuthAssignment::ROLE_GUEST,
                'child' => AuthAssignment::PERMISSION_GUEST,
                'child_type' => AuthItemChild::TYPE_PERMISSION
            ],
            [
                'parent' => AuthAssignment::ROLE_USER,
                'child' => AuthAssignment::PERMISSION_USER,
                'child_type' => AuthItemChild::TYPE_PERMISSION
            ],
        ]);

        $user = DB::table('users')->first();
        DB::table('auth_assignments')->insert([
            'item_name' => AuthAssignment::ROLE_SUPER_ADMIN,
            'user_id' => $user->id
        ]);


    }
}
