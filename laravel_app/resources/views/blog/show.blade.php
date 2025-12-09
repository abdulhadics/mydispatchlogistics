@extends('layouts.app')

@section('title', $article['title'] . ' - MyDispatch Blog')
@section('description', substr(strip_tags($article['content']), 0, 160))
@section('body_class', 'blog-post-page')

@section('content')
    <section class="hero" style="padding: 6rem 0 4rem;">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <div class="badge mb-3"
                    style="background: rgba(139, 92, 246, 0.2); color: #a78bfa; padding: 0.5rem 1rem; border-radius: 2rem; display: inline-block;">
                    {{ $article['category'] }}
                </div>
                <h1 class="h2">{{ $article['title'] }}</h1>
                <p class="text-gray-400">
                    By <span class="text-white">{{ $article['author'] }}</span> • {{ $article['date'] }}
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-narrow">
            <div class="card" style="padding: 3rem; max-width: 800px; margin: 0 auto;">
                <div class="article-content" style="color: #d1d5db; line-height: 1.8; font-size: 1.1rem;">
                    {!! $article['content'] !!}
                </div>

                <div class="mt-5 pt-5 border-t border-gray-800 text-center">
                    <a href="{{ route('blog') }}" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Back to Blog
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .article-content h4 {
            color: white;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .article-content ul {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }
    </style>
@endsection