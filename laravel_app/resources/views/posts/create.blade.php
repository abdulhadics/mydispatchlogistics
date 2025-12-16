@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add New Post</h2>
                </div>
                <div class="pull-right" style="margin-bottom: 20px;">
                    <a class="btn btn-primary" href="{{ route('posts.index') }}"
                        style="background-color: #6c757d; border-color: #6c757d; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px;">
                        Back</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger"
                style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 15px;">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px;">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 15px;">
                    <div class="form-group">
                        <strong>Content:</strong>
                        <textarea class="form-control"
                            style="height:150px; width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px;"
                            name="content" placeholder="Content"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 15px;">
                    <div class="form-group">
                        <strong>Author:</strong>
                        <input type="text" name="author" class="form-control" placeholder="Author Name"
                            style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px;">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary"
                        style="background-color: #007bff; border-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer;">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection