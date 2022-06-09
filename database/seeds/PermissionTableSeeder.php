<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'التقارير',
            'تقرير المنتجات',
            'تقرير العملاء',
            'المستخدمين',
            'قائمة المستخدمين',
            'صلاحيات المستخدمين',
            'الاعدادات',
            'المنتجات',
            'الاقسام',


            'عرض الصورة',
            'اضافة منتج',
            'تعديل منتج',
            'حذف المنتج',

            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',

            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',

            'اضافة قسم',
            'تعديل قسم',
            'حذف قسم',
        
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
