@extends('layouts.auth')

@section('title', 'Sign Up - MyDispatch')

@section('content')
    <div class="auth-header">
        <h2>Create Account</h2>
        <p>Join MyDispatch and start your logistics journey.</p>
    </div>

    <form method="POST" action="{{ route('signup') }}" class="signup-form">
        @csrf

        @if ($errors->any())
            <div class="alert alert-error mb-4"
                style="background: rgba(220, 38, 38, 0.1); border: 1px solid rgba(220, 38, 38, 0.2); color: #fca5a5; padding: 1rem; border-radius: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Name -->
        <div class="form-group mb-4">
            <label for="name" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Full
                Name</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-user"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="text" id="name" name="name" class="form-input" placeholder="Enter your full name"
                    value="{{ old('name') }}" required autocomplete="name"
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
            </div>
        </div>

        <!-- Email -->
        <div class="form-group mb-4">
            <label for="email" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Email
                Address</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-envelope"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email"
                    value="{{ old('email') }}" required autocomplete="email"
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
            </div>
        </div>

        <!-- Phone -->
        <div class="form-group mb-4">
            <label for="phone" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Phone
                Number</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-phone"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="tel" id="phone" name="phone" class="form-input" placeholder="Enter your phone number"
                    value="{{ old('phone') }}" autocomplete="tel"
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
            </div>
        </div>

        <!-- Role -->
        <div class="form-group mb-4">
            <label for="role" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Account
                Type</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-user-tag"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <select id="role" name="role" class="form-input" required
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s; appearance: none;">
                    <option value="">Select account type</option>
                    <option value="driver" {{ old('role') === 'driver' ? 'selected' : '' }}>Driver/Owner Operator</option>
                    <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>Customer/Shipper</option>
                </select>
                <i class="fas fa-chevron-down"
                    style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280; pointer-events: none;"></i>
            </div>
        </div>

        <!-- Company (Conditional) -->
        <div class="form-group mb-4" id="companyGroup" style="display: none;">
            <label for="company" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Company
                Name</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-building"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="text" id="company" name="company" class="form-input" placeholder="Enter your company name"
                    value="{{ old('company') }}"
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
            </div>
        </div>

        <!-- MC Number (Conditional) -->
        <div class="form-group mb-4" id="mcNumberGroup" style="display: none;">
            <label for="mc_number" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">MC
                Number</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-id-card"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="text" id="mc_number" name="mc_number" class="form-input" placeholder="Enter your MC number"
                    value="{{ old('mc_number') }}"
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
            </div>
        </div>

        <!-- Password -->
        <div class="form-group mb-4">
            <label for="password" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Password</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-lock"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="password" id="password" name="password" class="form-input" placeholder="Create a password"
                    required autocomplete="new-password"
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
                <button type="button" onclick="togglePasswordVisibility('password')"
                    style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #6b7280; cursor: pointer;">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group mb-6">
            <label for="password_confirmation" class="form-label"
                style="display: block; color: #d1d5db; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Confirm
                Password</label>
            <div class="input-group" style="position: relative;">
                <i class="fas fa-lock"
                    style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                    placeholder="Confirm your password" required autocomplete="new-password"
                    style="width: 100%; background: #1f2937; border: 1px solid #374151; color: white; padding: 0.75rem 1rem 0.75rem 2.5rem; border-radius: 0.5rem; outline: none; transition: all 0.2s;">
            </div>
        </div>

        <!-- Terms -->
        <div class="form-group mb-6">
            <label class="flex items-start gap-2"
                style="display: flex; align-items: flex-start; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" name="terms" required
                    style="accent-color: #8b5cf6; width: 1rem; height: 1rem; margin-top: 0.25rem;">
                <span style="color: #9ca3af; font-size: 0.875rem; line-height: 1.4;">
                    I agree to the <a href="#" style="color: #8b5cf6; text-decoration: none;">Terms of Service</a> and <a
                        href="#" style="color: #8b5cf6; text-decoration: none;">Privacy Policy</a>
                </span>
            </label>
        </div>

        <button type="submit" class="btn btn-primary w-full" style="width: 100%; padding: 0.875rem; font-size: 1rem;">Create
            Account</button>

        <p class="text-center mt-6" style="text-align: center; margin-top: 1.5rem; color: #9ca3af; font-size: 0.875rem;">
            Already have an account? <a href="{{ route('login') }}"
                style="color: #8b5cf6; text-decoration: none; font-weight: 600;">Sign in</a>
        </p>
    </form>

    @push('scripts')
        <script>
            // Show/hide conditional fields based on role selection
            document.getElementById('role').addEventListener('change', function () {
                const role = this.value;
                const companyGroup = document.getElementById('companyGroup');
                const mcNumberGroup = document.getElementById('mcNumberGroup');

                if (role === 'driver') {
                    companyGroup.style.display = 'block';
                    mcNumberGroup.style.display = 'block';
                } else if (role === 'customer') {
                    companyGroup.style.display = 'block';
                    mcNumberGroup.style.display = 'none';
                } else {
                    companyGroup.style.display = 'none';
                    mcNumberGroup.style.display = 'none';
                }
            });

            function togglePasswordVisibility(id) {
                const input = document.getElementById(id);
                input.type = input.type === 'password' ? 'text' : 'password';
            }
        </script>
    @endpush
@endsection