<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'مدير النظام',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Mentors
        $mentors = [
            [
                'name' => 'د. أحمد علي',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password'),
                'role' => 'mentor',
                'bio' => 'خبير في تطوير البرمجيات لأكثر من 10 سنوات.',
                'job_title' => 'Senior Developer',
                'company' => 'Google',
            ],
            [
                'name' => 'م. سارة محمود',
                'email' => 'sara@example.com',
                'password' => Hash::make('password'),
                'role' => 'mentor',
                'bio' => 'متخصصة في تحليل البيانات والذكاء الاصطناعي.',
                'job_title' => 'Data Scientist',
                'company' => 'Microsoft',
            ],
        ];

        foreach ($mentors as $mentorData) {
            User::firstOrCreate(
                ['email' => $mentorData['email']],
                $mentorData
            );
        }

        // Create Graduates
        $graduates = [
            [
                'name' => 'محمد كمال',
                'email' => 'mohamed@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'ليلى إبراهيم',
                'email' => 'laila@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ];

        foreach ($graduates as $graduateData) {
            User::firstOrCreate(
                ['email' => $graduateData['email']],
                $graduateData
            );
        }
    }
}
