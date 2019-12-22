<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //Sites

        DB::table('asset_types')->insert([
            'name' => 'Head Office',
            'city' => 'London',
            'country' => 'United Kingdom',
            'postcode' => '1T0 00A'
        ]);

        //Admin user

        DB::table('users')->insert([
            'first_name' => 'John',
            'site_id' => 1,
            'last_name' => 'Doe',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => '',
            'job_title' => 'IT Admin',
            'can_login' => true
        ]);

        //User roles

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
            'description' => 'Administrator privileges',
        ]);

        //Assign user role to admin

        DB::table('role_user')->insert([
            'id' => 1,
            'role_id' => 1,
            'user_id' => 1,
        ]);

        //Default states

        DB::table('states')->insert([
            'name' => 'In Storage',
            'description' => ''
        ]);

        DB::table('states')->insert([
            'name' => 'In Use',
            'description' => ''
        ]);

        DB::table('states')->insert([
            'name' => 'In Repair',
            'description' => ''
        ]);

        DB::table('states')->insert([
            'name' => 'Disposed',
            'description' => ''
        ]);

        //Asset types

        DB::table('asset_types')->insert([
            'name' => 'Laptops',
            'icon' => 'laptop'
        ]);

        DB::table('asset_types')->insert([
            'name' => 'Desktops',
            'icon' => 'desktop_mac'
        ]);

        DB::table('asset_types')->insert([
            'name' => 'Mobile phones',
            'icon' => 'smartphone'
        ]);

        DB::table('asset_types')->insert([
            'name' => 'Printers',
            'icon' => 'print'
        ]);

        //factory(User::class)->create();
        //factory(Role::class)->create();
    }
}
