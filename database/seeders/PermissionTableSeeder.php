<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //Roles
            ['name'=>'role-list','name_ar'=>'قائمة الصلاحيات','routes'=>'admin.roles.index'],
            ['name'=>'role-create','name_ar'=>'انشاء صلاحية','routes'=>'admin.roles.index'],
            ['name'=>'role-edit','name_ar'=>' تعديل صلاحية','routes'=>'admin.roles.index'],
            ['name'=>'role-delete','name_ar'=>'حذف صلاحية','routes'=>'admin.roles.index,admin.roles.destroy'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
