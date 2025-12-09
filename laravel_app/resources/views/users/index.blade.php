@extends('layouts.app')

@section('title', 'Manage Users - MyDispatch Admin')
@section('body_class', 'admin-page')

@section('content')
    <div class="container" style="padding: 2rem 20px;">
        <div class="section-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h1 class="h2">Manage Users</h1>
                <p style="color: #737373;">View and manage all registered users</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add User
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success"
                style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); color: #22c55e; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card"
            style="background: rgba(23, 23, 23, 0.5); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 0; overflow: hidden;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div
                                        style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span style="font-weight: 500; display: block;">{{ $user->name }}</span>
                                        <span style="color: #525252; font-size: 0.75rem;">ID: {{ $user->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td style="color: #a3a3a3;">{{ $user->email }}</td>
                            <td>
                                <span
                                    class="status-badge {{ $user->role === 'admin' ? 'active' : ($user->role === 'driver' ? 'pending' : 'inactive') }}"
                                    style="text-transform: capitalize;">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge {{ $user->status ?? 'active' }}">
                                    {{ ucfirst($user->status ?? 'active') }}
                                </span>
                            </td>
                            <td style="color: #737373;">{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline btn-sm"
                                        style="padding: 0.5rem 0.75rem;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline btn-sm"
                                                style="padding: 0.5rem 0.75rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.3);"
                                                onclick="return confirm('Delete this user?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: #525252;">
                                <i class="fas fa-users" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 2rem;">
            {{ $users->links() }}
        </div>
    </div>
@endsection