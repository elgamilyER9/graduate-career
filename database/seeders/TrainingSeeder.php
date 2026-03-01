<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\User;
use App\Models\CareerPath;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a mentor user (or create one if doesn't exist)
        $mentor = User::where('role', 'mentor')->first();
        
        if (!$mentor) {
            $mentor = User::create([
                'name' => 'أحمد المرشد',
                'email' => 'mentor@example.com',
                'password' => bcrypt('password'),
                'role' => 'mentor',
            ]);
        }

        // Get first career path (or create one if doesn't exist)
        $careerPath = CareerPath::first();
        
        if (!$careerPath) {
            $careerPath = CareerPath::create([
                'name' => 'هندسة البرمجيات',
            ]);
        }

        // Create sample trainings
        $trainings = [
            [
                'title' => 'مقدمة في تطوير الويب',
                'name' => 'مقدمة في تطوير الويب',
                'description' => 'تعلم أساسيات HTML و CSS و JavaScript لبناء مواقع ويب احترافية',
                'mentor_id' => $mentor->id,
                'career_path_id' => $careerPath->id,
                'provider' => 'قسم التطوير',
            ],
            [
                'title' => 'Laravel للمبتدئين',
                'name' => 'Laravel للمبتدئين',
                'description' => 'دورة شاملة في تعلم إطار العمل Laravel من الصفر إلى الاحتراف',
                'mentor_id' => $mentor->id,
                'career_path_id' => $careerPath->id,
                'provider' => 'قسم التطوير',
            ],
            [
                'title' => 'تصميم قاعدة البيانات',
                'name' => 'تصميم قاعدة البيانات',
                'description' => 'تصميم وإدارة قواعد البيانات العلائقية وتحسين الأداء',
                'mentor_id' => $mentor->id,
                'career_path_id' => $careerPath->id,
                'provider' => 'قسم البيانات',
            ],
            [
                'title' => 'البرمجة بلغة Python',
                'name' => 'البرمجة بلغة Python',
                'description' => 'تعلم Python لتطوير التطبيقات وتحليل البيانات',
                'mentor_id' => $mentor->id,
                'career_path_id' => $careerPath->id,
                'provider' => 'قسم البرمجة',
            ],
            [
                'title' => 'مبادئ التصميم UI/UX',
                'name' => 'مبادئ التصميم UI/UX',
                'description' => 'تعلم أساسيات تصميم الواجهات والتجربة المستخدم',
                'mentor_id' => $mentor->id,
                'career_path_id' => $careerPath->id,
                'provider' => 'قسم التصميم',
            ],
        ];

        foreach ($trainings as $training) {
            Training::firstOrCreate(
                ['title' => $training['title']],
                $training
            );
        }
    }
}
