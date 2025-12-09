<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,driver,customer',
            'password' => 'required|min:8|confirmed',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Notification::createNotification(
            auth()->id(),
            'User Created',
            "New user '{$user->name}' has been created successfully.",
            'success',
            'fa-user-plus'
        );

        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,driver,customer',
            'status' => 'required|in:active,inactive,pending',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        Notification::createNotification(
            auth()->id(),
            'User Updated',
            "User '{$user->name}' has been updated successfully.",
            'info',
            'fa-user-edit'
        );

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $userName = $user->name;
        $user->delete();

        Notification::createNotification(
            auth()->id(),
            'User Deleted',
            "User '{$userName}' has been deleted.",
            'warning',
            'fa-user-minus'
        );

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}
