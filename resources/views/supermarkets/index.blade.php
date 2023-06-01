@extends('layouts.app')

@section('content')
    <div>
        <h1>Supermarkets</h1>

        <div>
            <a href="{{ route('supermarkets.create') }}" class="btn btn-primary">Add Supermarket</a>
        </div>

        <div class="mt-3">
            <form action="{{ route('supermarkets.index') }}" method="GET" class="form-inline">
                <div class="form-group">
                    <label for="viewType">View Type:</label>
                    <select name="viewType" id="viewType" class="form-control">
                        <option value="grid" {{ $viewType === 'grid' ? 'selected' : '' }}>Grid</option>
                        <option value="list" {{ $viewType === 'list' ? 'selected' : '' }}>List</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Apply</button>
            </form>
        </div>

        <div class="mt-3">
            @if ($viewType === 'grid')
                <div class="row">
                    @foreach ($supermarkets as $supermarket)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $supermarket->name }}</h5>
                                    <p class="card-text">{{ $supermarket->location }}</p>
                                    <a href="{{ route('supermarkets.edit', $supermarket) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('supermarkets.destroy', $supermarket) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('supermarkets.import-employees', $supermarket) }}" class="btn btn-primary">Add Manager</a>
                                    <a href="{{ route('supermarkets.import-suppliers', $supermarket) }}" class="btn btn-primary">Import </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($supermarkets as $supermarket)
                        <tr>
                            <td>{{ $supermarket->name }}</td>
                            <td>{{ $supermarket->location }}</td>
                            <td>
                                <a href="{{ route('supermarkets.edit', $supermarket) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('supermarkets.destroy', $supermarket) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
