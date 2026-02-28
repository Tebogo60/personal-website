<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['nullable', 'max:20'],
            'linkedin' => ['nullable', Rule::unique('users', 'linkedin')],
            'github' => ['nullable', Rule::unique('users', 'github')],
            'password' => ['required', 'confirmed', 'min:6', 'max:20']
        ]);

        $formFields['name'] = strip_tags($formFields['name']);
        $formFields['phone'] = strip_tags($formFields['phone']);
        $formFields['email'] = strip_tags($formFields['email']);
        $formFields['linkedin'] = strip_tags($formFields['linkedin']) ?? null;
        $formFields['github'] = strip_tags($formFields['github']) ?? null;
        $formFields['role'] = 'GENERAL';
        $formFields['is_verified'] = false;
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        auth()->login($user);
        return redirect('/');
    }

    public function loginUser(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'min:3'],
            'password' => ['required']
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/');
        };

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function logoutUser()
    {
        auth()->logout();
        return redirect('/');
    }
}
