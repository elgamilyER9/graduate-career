<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareerPath;

class CareerPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paths = [
            'تطوير الويب (Full Stack)',
            'تطوير تطبيقات الموبايل (Flutter/React Native)',
            'علوم البيانات والذكاء الاصطناعي',
            'الأمن السيبراني',
            'الحوسبة السحابية و DevOps',
            'التسويق الرقمي',
            'التصميم الجرافيكي و UI/UX',
            'إدارة المشاريع',
            'تحليل الأعمال',
            'اختبار البرمجيات وضمان الجودة',
        ];

        foreach ($paths as $path) {
            CareerPath::create(['name' => $path]);
        }
    }
}
