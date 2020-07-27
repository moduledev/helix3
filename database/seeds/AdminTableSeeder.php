<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create(['name' => 'Serhii','email' => 'admin@admin.com','password' => Hash::make('password'),'phone' => '0985594949']);
        $admin->givePermissionTo('admin-list');
        $admin->givePermissionTo('admin-create');
        $admin->givePermissionTo('admin-edit');
        $admin->givePermissionTo('admin-delete');

        $admin->givePermissionTo('user-list');
        $admin->givePermissionTo('user-create');
        $admin->givePermissionTo('user-edit');
        $admin->givePermissionTo('user-delete');

        $admin->givePermissionTo('role-list');
        $admin->givePermissionTo('role-create');
        $admin->givePermissionTo('role-edit');
        $admin->givePermissionTo('role-delete');
        $admin->givePermissionTo('role-assign');
        $admin->givePermissionTo('role-revoke');

        $admin->givePermissionTo('program-list');
        $admin->givePermissionTo('program-create');
        $admin->givePermissionTo('program-edit');
        $admin->givePermissionTo('program-delete');

        Admin::create(['name' => 'Екатерина Байдуж','email' => 'kat@admin.com','password' => Hash::make('12345678')]);
    }
}
