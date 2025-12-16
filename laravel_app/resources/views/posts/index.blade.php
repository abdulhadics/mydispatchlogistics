@extends('layouts.app')

@section('title', 'Manual CRUD Demo')

@section('content')
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Manual CRUD Demo</h2>
                </div>
                <div class="pull-right" style="text-align: right; margin-bottom: 20px;">
                    <a class="btn btn-success" href="{{ route('posts.create') }}"
                        style="background-color: #28a745; border-color: #28a745; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px;">Create
                        New Post</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success"
                style="color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="padding: 12px; border: 1px solid #dee2e6; text-align: left;">Title</th>
                    <th style="padding: 12px; border: 1px solid #dee2e6; text-align: left;">Content</th>
                    <th style="padding: 12px; border: 1px solid #dee2e6; text-align: left;">Author</th>
                    <th style="padding: 12px; border: 1px solid #dee2e6; text-align: left; width: 200px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $post->title }}</td>
                        <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $post->content }}</td>
                        <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $post->author }}</td>
                        <td style="padding: 12px; border: 1px solid #dee2e6;">
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}"
                                    style="background-color: #007bff; border-color: #007bff; color: white; text-decoration: none; padding: 5px 10px; border-radius: 3px; margin-right: 5px;">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    style="background-color: #dc3545; border-color: #dc3545; color: white; padding: 5px 10px; border-radius: 3px; border: none; cursor: pointer;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection