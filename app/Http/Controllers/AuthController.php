<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $route = Auth::user()->isStudent() ? 'subjects.index' : 'dashboard';
            return redirect()->route($route)
                ->with('toast_success', 'Welcome back, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('toast_error', 'Invalid email or password. Please try again.');
    }

    public function showRegister()
    {
        $departments = Department::orderBy('name')->get();
        return view('auth.register', compact('departments'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'unique:users,email'],
            'password'       => ['required', 'confirmed', Password::min(8)],
            'student_number' => ['required', 'string', 'max:50', 'unique:users,student_number'],
            'department_id'  => ['required', 'exists:departments,id'],
        ]);

        $user = User::create([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'password'       => Hash::make($validated['password']),
            'role'           => 'student',
            'student_number' => $validated['student_number'],
            'department_id'  => $validated['department_id'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $route = $user->isStudent() ? 'subjects.index' : 'dashboard';
        return redirect()->route($route)
            ->with('toast_success', 'Registration successful! Welcome to SchoolSys, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->with('toast_success', 'You have been logged out successfully.');
    }
}
