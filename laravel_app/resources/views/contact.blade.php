@extends('layouts.app')

@section('title', 'Contact Us - MyDispatch')
@section('description', 'Get in touch with our team for any inquiries or support. We are here to help you 24/7.')
@section('body_class', 'contact-page')

@section('content')
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <h1>Contact Us</h1>
                <p class="p-lg">
                    Have questions? We're here to help. Reach out to us anytime.
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-narrow">
            <div class="card">
                <div class="card-body">
                    <div class="features-grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <h2 class="card-title">Get in Touch</h2>
                            <p class="card-subtitle mb-4">Fill out the form and we'll get back to you as soon as possible.
                            </p>

                            <form action="{{ route('contact.store') }}" method="POST" class="login-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <div class="input-group">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" id="name" name="name" class="form-input" placeholder="Your Name"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="email" id="email" name="email" class="form-input"
                                            placeholder="Your Email" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="message" class="form-label">Message</label>
                                    <div class="input-group">
                                        <textarea id="message" name="message" class="form-input" rows="5"
                                            placeholder="How can we help you?" required
                                            style="padding-left: 1rem;"></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-full">
                                    Send Message
                                </button>
                            </form>
                        </div>

                        <div style="display: flex; flex-direction: column; justify-content: center;">
                            <div class="feature-card mb-4">
                                <div class="feature-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h3>Our Office</h3>
                                <p>123 Logistics Way<br>Transport City, TC 90210</p>
                            </div>

                            <div class="feature-card mb-4">
                                <div class="feature-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h3>Phone</h3>
                                <p>+1 (555) 123-4567</p>
                            </div>

                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3>Email</h3>
                                <p>support@mydispatch.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection