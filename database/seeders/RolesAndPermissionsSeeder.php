<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Reset cached roles and permissions
      app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      // create permissions
      Permission::create(['name' => 'create business']);
      Permission::create(['name' => 'update business']);
      Permission::create(['name' => 'delete business']);
      Permission::create(['name' => 'create category']);
      Permission::create(['name' => 'update category']);
      Permission::create(['name' => 'delete category']);

      // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
      app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      // create roles and assign created permissions
      $role = Role::create(['name' => 'super-admin']);
      $role->givePermissionTo(Permission::all());

      // or may be done by chaining
      $role = Role::create(['name' => 'admin'])
        ->givePermissionTo([
            'create business',
            'update business',
            'delete business',
            'create category',
            'update category',
            'delete category']);
        // this can be done as separate statements
        $role = Role::create(['name' => 'client']);
        $role->givePermissionTo('update business');
        $role->givePermissionTo('update category');
    }
}
