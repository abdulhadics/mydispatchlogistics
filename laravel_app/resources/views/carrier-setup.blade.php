@extends('layouts.app')

@section('title', 'Carrier Setup - MyDispatch')
@section('description', 'Join our network of reliable carriers. Complete the setup form to start hauling with MyDispatch.')
@section('body_class', 'carrier-setup-page')

@section('content')
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <h1>Carrier Setup</h1>
                <p class="p-lg">
                    Join our network and start accessing premium loads today.
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-narrow">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Carrier Information Form</h2>
                    <p class="card-subtitle">Please fill out the details below to register as a carrier.</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('carrier-setup.store') }}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="company_name" class="form-label">Company Name</label>
                            <div class="input-group">
                                <i class="fas fa-building input-icon"></i>
                                <input type="text" id="company_name" name="company_name" class="form-input"
                                    placeholder="Enter your company name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mc_number" class="form-label">MC Number</label>
                            <div class="input-group">
                                <i class="fas fa-hashtag input-icon"></i>
                                <input type="text" id="mc_number" name="mc_number" class="form-input"
                                    placeholder="Enter MC Number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dot_number" class="form-label">DOT Number</label>
                            <div class="input-group">
                                <i class="fas fa-hashtag input-icon"></i>
                                <input type="text" id="dot_number" name="dot_number" class="form-input"
                                    placeholder="Enter DOT Number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_name" class="form-label">Contact Name</label>
                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" id="contact_name" name="contact_name" class="form-input"
                                    placeholder="Full Name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" id="email" name="email" class="form-input"
                                    placeholder="name@company.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <i class="fas fa-phone input-icon"></i>
                                <input type="tel" id="phone" name="phone" class="form-input" placeholder="(555) 123-4567"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="equipment_type" class="form-label">Equipment Type</label>
                            <div class="input-group">
                                <i class="fas fa-truck input-icon"></i>
                                <select id="equipment_type" name="equipment_type" class="form-input" required>
                                    <option value="" disabled selected>Select Equipment Type</option>
                                    <option value="dry_van">Dry Van</option>
                                    <option value="reefer">Reefer</option>
                                    <option value="flatbed">Flatbed</option>
                                    <option value="step_deck">Step Deck</option>
                                    <option value="power_only">Power Only</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-full">
                            Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection