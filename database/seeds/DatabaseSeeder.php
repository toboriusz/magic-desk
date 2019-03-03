<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Technician;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $technician = factory(Technician::class)->create();
        $role = factory(Role::class)->create();

        $technician->roles()->attach($role);
    }
}
