<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;
use App\Models\CareerPath;

class JobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mentors = User::where('role', 'mentor')->get();
        $careerPaths = CareerPath::all();

        if ($mentors->isEmpty()) {
            return;
        }

        if ($careerPaths->isEmpty()) {
            return;
        }

        $dummyJobs = [
            [
                'title' => 'Senior Laravel Developer',
                'company' => 'Tech Solutions Corp',
                'description' => 'Looking for an experienced Laravel developer to join our core team and lead new feature development.',
            ],
            [
                'title' => 'Junior Frontend Engineer',
                'company' => 'Creative Web Agency',
                'description' => 'Great opportunity for a junior developer to work with Vue.js and Tailwind CSS on exciting projects.',
            ],
            [
                'title' => 'Project Manager',
                'company' => 'Innovation Hub',
                'description' => 'Help us manage multiple software projects and lead diverse teams of developers.',
            ],
            [
                'title' => 'Backend Engineer (Node.js)',
                'company' => 'FinTech Innovators',
                'description' => 'Work on high-performance backend systems powering financial applications.',
            ],
            [
                'title' => 'UI/UX Designer',
                'company' => 'Product Studio',
                'description' => 'Design beautiful and intuitive user experiences for our enterprise clients.',
            ],
            [
                'title' => 'Mobile Developer (Flutter)',
                'company' => 'Startup Founders',
                'description' => 'Build cross-platform mobile apps using Flutter and help our startup grow.',
            ],
        ];

        foreach ($mentors as $mentor) {
            // Give each mentor 2-3 random jobs from the list
            $numJobs = rand(2, 3);
            $shuffledJobs = $dummyJobs;
            shuffle($shuffledJobs);

            for ($i = 0; $i < $numJobs; $i++) {
                $jobData = $shuffledJobs[$i];
                Job::create([
                    'title' => $jobData['title'],
                    'company' => $jobData['company'],
                    'career_path_id' => $careerPaths->random()->id,
                    'mentor_id' => $mentor->id,
                ]);
            }
        }
    }
}
