@extends('layouts.app')

@section('title', 'Post New Load')

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
        <div class="card" style="max-width: 800px; margin: 0 auto;">
            <div class="card-header">
                <h2 class="h2 mb-0">Post a New Load</h2>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('loads.store') }}" method="POST">
                @csrf

                <div class="form-row"
                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group mb-0">
                        <label for="pickup_location" class="form-label">Pickup Location</label>
                        <input type="text" name="pickup_location" id="pickup_location" class="form-input" required
                            placeholder="City, State">
                    </div>
                    <div class="form-group mb-0">
                        <label for="delivery_location" class="form-label">Delivery Location</label>
                        <input type="text" name="delivery_location" id="delivery_location" class="form-input" required
                            placeholder="City, State">
                    </div>
                </div>

                <div class="form-row"
                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group mb-0">
                        <label for="pickup_date" class="form-label">Pickup Date</label>
                        <input type="datetime-local" name="pickup_date" id="pickup_date" class="form-input" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="delivery_date" class="form-label">Delivery Date</label>
                        <input type="datetime-local" name="delivery_date" id="delivery_date" class="form-input" required>
                    </div>
                </div>

                <div class="form-row"
                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group mb-0">
                        <label for="weight" class="form-label">Weight (lbs)</label>
                        <input type="number" step="0.01" name="weight" id="weight" class="form-input" required
                            placeholder="0.00">
                    </div>
                    <div class="form-group mb-0">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-input" required
                            placeholder="0.00">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description / Special Requirements</label>
                    <textarea name="description" id="description" rows="4" class="form-input"
                        style="resize: vertical; min-height: 100px;"></textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Post Load
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection