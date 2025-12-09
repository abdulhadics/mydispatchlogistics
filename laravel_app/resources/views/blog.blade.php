@extends('layouts.app')

@section('title', 'Blog - MyDispatch')
@section('description', 'Industry news, tips, and insights for truckers and fleet owners.')
@section('body_class', 'blog-page')

@section('content')
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <h1>Industry Insights</h1>
                <p class="p-lg">
                    News, tips, and strategies to help you run a better trucking business.
                </p>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container-narrow">
            <div class="features-grid">
                <div class="card">
                    <div class="card-body">
                        <div class="badge mb-2">Industry News</div>
                        <h3>Fuel Prices Outlook for 2024</h3>
                        <p class="mb-4">What experts are predicting for diesel prices in the coming year and how to prepare.
                        </p>
                        <a href="{{ route('blog.show', 'fuel-prices-2024') }}" class="btn btn-outline btn-sm">Read More</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="badge mb-2">Tips & Tricks</div>
                        <h3>Maximizing Fuel Efficiency</h3>
                        <p class="mb-4">Simple maintenance tips and driving habits that can save you thousands per year.</p>
                        <a href="{{ route('blog.show', 'maximizing-fuel-efficiency') }}" class="btn btn-outline btn-sm">Read
                            More</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="badge mb-2">Regulation</div>
                        <h3>New DOT Regulations Explained</h3>
                        <p class="mb-4">Everything you need to know about the latest compliance changes affecting carriers.
                        </p>
                        <a href="{{ route('blog.show', 'dot-regulations-explained') }}" class="btn btn-outline btn-sm">Read
                            More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection