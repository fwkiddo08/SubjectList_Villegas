<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::with('department');

        if (Auth::user()->isStudent()) {
            $query->where('department_id', Auth::user()->department_id);
        }

        // Search
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by department
        if ($deptId = $request->get('department_id')) {
            $query->where('department_id', $deptId);
        }

        // Filter by type
        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        // Filter by status
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // Sort
        $sortBy  = $request->get('sort', 'created_at');
        $sortDir = $request->get('dir', 'desc');
        $allowed = ['code', 'name', 'units', 'type', 'status', 'created_at'];
        if (in_array($sortBy, $allowed)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        }

        $subjects    = $query->paginate(10)->withQueryString();
        $departments = Department::orderBy('name')->get();

        return view('subjects.index', compact('subjects', 'departments'));
    }

    public function show(Subject $subject)
    {
        if (Auth::user()->isStudent() && $subject->department_id !== Auth::user()->department_id) {
            abort(403);
        }

        $subject->load('department');
        return view('subjects.show', compact('subject'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->isStudent()) {
            abort(403);
        }

        $validated = $request->validate([
            'code'          => ['required', 'string', 'max:20', 'unique:subjects,code'],
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'units'         => ['required', 'integer', 'min:1', 'max:10'],
            'type'          => ['required', 'in:lecture,lab,seminar'],
            'status'        => ['required', 'in:active,inactive'],
            'department_id' => ['nullable', 'exists:departments,id'],
        ]);

        Subject::create($validated);

        return back()->with('toast_success', 'Subject "' . $validated['name'] . '" added successfully!');
    }

    public function update(Request $request, Subject $subject)
    {
        if (Auth::user()->isStudent()) {
            abort(403);
        }

        $validated = $request->validate([
            'code'          => ['required', 'string', 'max:20', 'unique:subjects,code,' . $subject->id],
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'units'         => ['required', 'integer', 'min:1', 'max:10'],
            'type'          => ['required', 'in:lecture,lab,seminar'],
            'status'        => ['required', 'in:active,inactive'],
            'department_id' => ['nullable', 'exists:departments,id'],
        ]);

        $subject->update($validated);

        return back()->with('toast_success', 'Subject "' . $subject->name . '" updated successfully!');
    }

    public function destroy(Subject $subject)
    {
        if (Auth::user()->isStudent()) {
            abort(403);
        }

        $name = $subject->name;
        $subject->delete();
        return back()->with('toast_success', 'Subject "' . $name . '" deleted successfully!');
    }
}
