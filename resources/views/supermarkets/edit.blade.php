@extends('layouts.app')

@section('content')
    <div>
        <h1>Edit Supermarket</h1>

        <form action="{{ route('supermarkets.update', ['supermarket' => $supermarket->id]) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $supermarket->name }}" required>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ $supermarket->location }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('supermarkets.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
