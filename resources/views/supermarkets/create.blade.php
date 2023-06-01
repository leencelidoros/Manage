@extends('layouts.app')

@section('content')
    <div>
        <h1>Add Supermarket</h1>
        <!-- Example of accessing the $supermarket variable -->



        <div class="mt-3">
            <form action="{{ route('supermarkets.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" id="location" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ route('supermarkets.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
