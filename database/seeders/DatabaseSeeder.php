<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@schoolsys.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'gender' => 'Male',
            'address' => '123 School Ave, Metro City',
            'phone' => '09171234567',
        ]);

        // Create departments
        $departments = [
            ['name' => 'Computer Science', 'code' => 'CS', 'description' => 'Department covering computing, algorithms, and software development.', 'head' => 'Dr. Jose Reyes', 'status' => 'active'],
            ['name' => 'Information Technology', 'code' => 'IT', 'description' => 'Department focused on IT infrastructure and systems.', 'head' => 'Prof. Ana Cruz', 'status' => 'active'],
            ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Pure and applied mathematics department.', 'head' => 'Dr. Pedro Lim', 'status' => 'active'],
            ['name' => 'English', 'code' => 'ENG', 'description' => 'Language and communication arts department.', 'head' => 'Prof. Clara Diaz', 'status' => 'active'],
            ['name' => 'Natural Sciences', 'code' => 'SCI', 'description' => 'Physics, Chemistry, and Biology department.', 'head' => 'Dr. Ramon Flores', 'status' => 'active'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

        // Create sample student assigned to Computer Science
        User::create([
            'name' => 'Maria Santos',
            'email' => 'maria@schoolsys.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'gender' => 'Female',
            'address' => '456 University Blvd',
            'phone' => '09289876543',
            'department_id' => 1,
            'student_number' => '2026-00001',
        ]);

        // Create subjects
        $subjects = [
            ['code' => 'CS101', 'name' => 'Introduction to Programming', 'description' => 'Fundamentals of programming using Python.', 'units' => 3, 'type' => 'lecture', 'department_id' => 1, 'status' => 'active'],
            ['code' => 'CS102', 'name' => 'Data Structures & Algorithms', 'description' => 'Core data structures and algorithm analysis.', 'units' => 3, 'type' => 'lecture', 'department_id' => 1, 'status' => 'active'],
            ['code' => 'CS103', 'name' => 'Computer Networks', 'description' => 'Networking concepts, protocols, and architecture.', 'units' => 3, 'type' => 'lecture', 'department_id' => 1, 'status' => 'active'],
            ['code' => 'CS104', 'name' => 'Database Systems', 'description' => 'Relational databases and SQL fundamentals.', 'units' => 3, 'type' => 'lab', 'department_id' => 1, 'status' => 'active'],
            ['code' => 'IT101', 'name' => 'IT Fundamentals', 'description' => 'Introduction to information technology concepts.', 'units' => 3, 'type' => 'lecture', 'department_id' => 2, 'status' => 'active'],
            ['code' => 'IT102', 'name' => 'Web Development', 'description' => 'HTML, CSS, JavaScript and web frameworks.', 'units' => 3, 'type' => 'lab', 'department_id' => 2, 'status' => 'active'],
            ['code' => 'IT103', 'name' => 'Systems Analysis & Design', 'description' => 'SDLC methodologies and system design.', 'units' => 3, 'type' => 'lecture', 'department_id' => 2, 'status' => 'active'],
            ['code' => 'MATH101', 'name' => 'College Algebra', 'description' => 'Algebraic expressions, equations, and functions.', 'units' => 3, 'type' => 'lecture', 'department_id' => 3, 'status' => 'active'],
            ['code' => 'MATH102', 'name' => 'Calculus I', 'description' => 'Limits, derivatives and their applications.', 'units' => 4, 'type' => 'lecture', 'department_id' => 3, 'status' => 'active'],
            ['code' => 'MATH103', 'name' => 'Statistics & Probability', 'description' => 'Descriptive and inferential statistics.', 'units' => 3, 'type' => 'lecture', 'department_id' => 3, 'status' => 'active'],
            ['code' => 'ENG101', 'name' => 'English Communication', 'description' => 'Oral and written communication skills.', 'units' => 3, 'type' => 'lecture', 'department_id' => 4, 'status' => 'active'],
            ['code' => 'ENG102', 'name' => 'Technical Writing', 'description' => 'Writing technical documents and reports.', 'units' => 3, 'type' => 'lecture', 'department_id' => 4, 'status' => 'active'],
            ['code' => 'SCI101', 'name' => 'Physics I', 'description' => 'Mechanics, waves, and thermodynamics.', 'units' => 4, 'type' => 'lecture', 'department_id' => 5, 'status' => 'active'],
            ['code' => 'SCI102', 'name' => 'Chemistry I', 'description' => 'Atomic structure and chemical bonding.', 'units' => 4, 'type' => 'lab', 'department_id' => 5, 'status' => 'active'],
            ['code' => 'CS201', 'name' => 'Software Engineering', 'description' => 'Software development lifecycle and project management.', 'units' => 3, 'type' => 'seminar', 'department_id' => 1, 'status' => 'inactive'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
