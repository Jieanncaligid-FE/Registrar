<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'jieann@gmail.com'],
            [
                'name' => 'Registrar',
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Registrar Admin',
                'password' => Hash::make('password'),
            ]
        );

        $subjects = ['Mathematics', 'Science', 'English', 'History', 'Computer'];

        foreach ($subjects as $subjectName) {
            Subject::firstOrCreate(['subject_name' => $subjectName]);
        }
    }
}
