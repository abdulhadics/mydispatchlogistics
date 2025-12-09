@extends('layouts.app')

@section('title', 'Edit User - MyDispatch Admin')
@section('body_class', 'admin-page')

@section('content')
    <div class="container" style="padding: 2rem 20px; max-width: 600px;">
        <div class="section-header" style="margin-bottom: 2rem;">
            <a href="{{ route('users.index') }}"
                style="color: #737373; text-decoration: none; font-size: 0.875rem; display: block; margin-bottom: 1rem;">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>
            <h1 class="h2">Edit User</h1>
            <p style="color: #737373;">Update user information</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger"
                style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #ef4444; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card"
            style="background: rgba(23, 23, 23, 0.5); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 2rem;">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: #a3a3a3;">Full
                        Name</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required
                        style="width: 100%; padding: 0.75rem 1rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: #a3a3a3;">Email
                        Address</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required
                        style="width: 100%; padding: 0.75rem 1rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: #a3a3a3;">Phone
                        (Optional)</label>
                    <input type="text" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}"
                        style="width: 100%; padding: 0.75rem 1rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label"
                            style="display: block; margin-bottom: 0.5rem; color: #a3a3a3;">Role</label>
                        <select name="role" class="form-input" required
                            style="width: 100%; padding: 0.75rem 1rem; background: rgba(23,23,23,0.8); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                            <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer
                            </option>
                            <option value="driver" {{ old('role', $user->role) === 'driver' ? 'selected' : '' }}>Driver
                            </option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label"
                            style="display: block; margin-bottom: 0.5rem; color: #a3a3a3;">Status</label>
                        <select name="status" class="form-input" required
                            style="width: 100%; padding: 0.75rem 1rem; background: rgba(23,23,23,0.8); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                            <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                            <option value="pending" {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}>Pending
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: #a3a3a3;">New Password
                        <span style="color: #525252;">(leave blank to keep current)</span></label>
                    <input type="password" name="password" class="form-input" placeholder="••••••••"
                        style="width: 100%; padding: 0.75rem 1rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                </div>

                <div class="form-group" style="margin-bottom: 2rem;">
                    <label class="form-label" style="display: block; margin-bottom: 0.5rem; color: #a3a3a3;">Confirm New
                        Password</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••"
                        style="width: 100%; padding: 0.75rem 1rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                </div>

                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('users.index') }}" class="btn btn-outline"
                        style="flex: 1; text-align: center;">Cancel</a>
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Update User</button>
                </div>
            </form>
        </div>
    </div>
@endsection