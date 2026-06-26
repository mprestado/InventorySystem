<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()['cache']->forget('spatie.permission.cache');

        $permissions = [
            'view dashboard',
            'manage products',
            'manage categories',
            'manage brands',
            'manage suppliers',
            'manage customers',
            'manage stock_in',
            'manage stock_out',
            'manage adjustments',
            'manage purchase_orders',
            'process sales',
            'view reports',
            'manage users',
            'view activity_logs',
            'manage settings',
            'manage backups',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = [
            'Owner' => $permissions, // full access
            'Manager' => [
                'view dashboard', 'manage products', 'manage categories', 'manage brands',
                'manage suppliers', 'manage customers', 'manage stock_in', 'manage stock_out',
                'manage adjustments', 'manage purchase_orders', 'process sales', 'view reports',
                'view activity_logs',
            ],
            'Cashier' => [
                'view dashboard', 'process sales', 'manage customers',
            ],
            'Inventory Staff' => [
                'view dashboard', 'manage products', 'manage stock_in', 'manage stock_out',
                'manage adjustments', 'manage purchase_orders',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}
