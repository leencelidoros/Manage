@extends('layouts.app')

@section('content')
    <div>
        <h1>Import Suppliers</h1>

        <div class="mt-3">
            <form action="{{ route('supermarkets.import-suppliers', $supermarket) }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="csv_file">CSV File:</label>
                    <input type="file" name="csv_file" id="csv_file" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-primary">Import Suppliers</button>
                <a href="{{ route('supermarkets.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
