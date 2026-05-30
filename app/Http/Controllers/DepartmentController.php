<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Department::withCount('subjects');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('head', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $sortBy  = $request->get('sort', 'created_at');
        $sortDir = $request->get('dir', 'desc');
        $allowed = ['name', 'code', 'head', 'status', 'created_at', 'subjects_count'];
        if (in_array($sortBy, $allowed)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        }

        $departments = $query->paginate(10)->withQueryString();

        return view('departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255', 'unique:departments,name'],
            'code'        => ['required', 'string', 'max:20', 'unique:departments,code'],
            'description' => ['nullable', 'string'],
            'head'        => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:active,inactive'],
        ]);

        Department::create($validated);

        return back()->with('toast_success', 'Department "' . $validated['name'] . '" added successfully!');
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255', 'unique:departments,name,' . $department->id],
            'code'        => ['required', 'string', 'max:20', 'unique:departments,code,' . $department->id],
            'description' => ['nullable', 'string'],
            'head'        => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:active,inactive'],
        ]);

        $department->update($validated);

        return back()->with('toast_success', 'Department "' . $department->name . '" updated successfully!');
    }

    public function destroy(Department $department)
    {
        if ($department->subjects()->count() > 0) {
            return back()->with('toast_error', 'Cannot delete department with existing subjects. Please reassign or delete subjects first.');
        }

        $name = $department->name;
        $department->delete();

        return back()->with('toast_success', 'Department "' . $name . '" deleted successfully!');
    }
}
