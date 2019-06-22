<?php

use Illuminate\Database\Seeder;

class AdminLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\User;
        $admin->name = "Admin";
        $admin->email = "admin@admin.test";
        $admin->password = \Hash::make('admin');
        $admin->admin = "1";
        $admin->save();
    }
}
