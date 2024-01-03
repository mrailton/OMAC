<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_duty","view_any_duty","create_duty","update_duty","restore_duty","restore_any_duty","replicate_duty","reorder_duty","delete_duty","delete_any_duty","force_delete_duty","force_delete_any_duty","view_email","view_any_email","create_email","update_email","restore_email","restore_any_email","replicate_email","reorder_email","delete_email","delete_any_email","force_delete_email","force_delete_any_email","view_member","view_any_member","create_member","update_member","restore_member","restore_any_member","replicate_member","reorder_member","delete_member","delete_any_member","force_delete_member","force_delete_any_member","view_shield::role","view_any_shield::role","create_shield::role","update_shield::role","delete_shield::role","delete_any_shield::role","view_training::sessions","view_any_training::sessions","create_training::sessions","update_training::sessions","restore_training::sessions","restore_any_training::sessions","replicate_training::sessions","reorder_training::sessions","delete_training::sessions","delete_any_training::sessions","force_delete_training::sessions","force_delete_any_training::sessions","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_vehicle","view_any_vehicle","create_vehicle","update_vehicle","restore_vehicle","restore_any_vehicle","replicate_vehicle","reorder_vehicle","delete_vehicle","delete_any_vehicle","force_delete_vehicle","force_delete_any_vehicle","page_Backups","page_HealthCheckResults","page_Logs","widget_StatsOverview","page_SendEmail"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
