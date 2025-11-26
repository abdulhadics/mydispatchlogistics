@extends('layouts.app')

@section('title', 'About Us - MyDispatch')
@section('description', 'Learn more about MyDispatch, our mission, and the team dedicated to your success.')
@section('body_class', 'about-page')

@section('content')
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <h1>About MyDispatch</h1>
                <p class="p-lg">
                    Driving the future of logistics with technology and personalized service.
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-narrow">
            <div class="card">
                <div class="card-body">
                    <h2>Our Mission</h2>
                    <p>To empower owner-operators and small fleets with the tools, resources, and support they need to
                        compete with the big guys. We believe in transparency, fairness, and hard work.</p>

                    <h2 class="mt-4">Our Story</h2>
                    <p>Founded by former truckers and logistics experts, MyDispatch was born out of frustration with the
                        traditional dispatch model. We saw a need for a service that truly puts the driver first.</p>
                </div>
            </div>
        </div>
    </section>
@endsection