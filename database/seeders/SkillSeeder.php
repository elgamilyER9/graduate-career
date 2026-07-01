<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\CareerPath;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paths = CareerPath::all();

        if ($paths->isEmpty()) {
            return;
        }

        $skills = [
            'تطوير الويب (Full Stack)' => ['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js', 'SQL', 'HTML/CSS'],
            'تطوير تطبيقات الموبايل (Flutter/React Native)' => ['Dart', 'Flutter', 'React Native', 'Firebase', 'APIs'],
            'علوم البيانات والذكاء الاصطناعي' => ['Python', 'R', 'Machine Learning', 'Data Visualization', 'Pandas', 'NumPy'],
            'الأمن السيبراني' => ['Network Security', 'Penetration Testing', 'Cryptography', 'Linux', 'Ethical Hacking'],
            'التصميم الجرافيكي و UI/UX' => ['Figma', 'Adobe XD', 'Photoshop', 'Illustrator', 'User Research'],
        ];

        foreach ($skills as $pathName => $skillList) {
            $path = $paths->where('name', $pathName)->first();
            if ($path) {
                foreach ($skillList as $skillName) {
                    Skill::firstOrCreate([
                        'name' => $skillName,
                        'career_path_id' => $path->id
                    ]);
                }
            }
        }
    }
}
