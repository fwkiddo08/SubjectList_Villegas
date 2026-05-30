<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isStudent = $user->isStudent();
        $studentDepartment = $isStudent ? $user->department : null;

        $subjectQuery = Subject::with('department');
        if ($isStudent && $studentDepartment) {
            $subjectQuery = $subjectQuery->where('department_id', $studentDepartment->id);
        }

        $stats = [
            'total_subjects'    => (clone $subjectQuery)->count(),
            'active_subjects'   => (clone $subjectQuery)->where('status', 'active')->count(),
            'total_departments' => $isStudent ? ($studentDepartment ? 1 : Department::count()) : Department::count(),
            'total_users'       => User::count(),
        ];

        // Subjects per department for chart
        if ($isStudent && $studentDepartment) {
            $subjectsByDept = collect([[
                'name'  => $studentDepartment->name,
                'count' => $stats['total_subjects'],
            ]]);
        } else {
            $subjectsByDept = Department::withCount('subjects')
                ->orderBy('subjects_count', 'desc')
                ->get()
                ->filter(fn($d) => $d->subjects_count > 0)
                ->map(fn($d) => ['name' => $d->name, 'count' => $d->subjects_count])
                ->values();
        }

        // Subjects by type for pie chart
        $subjectsByType = Subject::select('type', DB::raw('count(*) as count'))
            ->when($isStudent && $studentDepartment, fn($query) => $query->where('department_id', $studentDepartment->id))
            ->groupBy('type')
            ->get()
            ->map(fn($s) => ['type' => ucfirst($s->type), 'count' => $s->count]);

        // Subjects by status
        $activeCount = (clone $subjectQuery)->where('status', 'active')->count();
        $inactiveCount = (clone $subjectQuery)->where('status', 'inactive')->count();

        // Recent subjects
        $recentSubjects = (clone $subjectQuery)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'stats',
            'subjectsByDept',
            'subjectsByType',
            'activeCount',
            'inactiveCount',
            'recentSubjects',
            'studentDepartment'
        ));
    }
}
