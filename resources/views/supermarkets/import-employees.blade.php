@extends('layouts.app')

@section('content')
    <div>
        <h1>Import Employees</h1>

        <div class="mt-3">
            <form action="{{ route('supermarkets.import-employees', $supermarket) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="csv_file">CSV File:</label>
                    <input type="file" name="csv_file" id="csv_file" class="form-control-file" required>
                </div><br>
                <div class="form-group">
                    <label for="manager_name">Manager Name:</label>
                    <input type="text" name="manager_name" id="manager_name" required>
                </div><br>
                <div class="form-group">
                    <label for="manager_phone">Manager Phone:</label>
                    <input type="text" name="manager_phone" id="manager_phone" required>
                </div><br>
                <div class="form-group">
                    <label for="manager_email">Manager Email:</label>
                    <input type="email" name="manager_email" id="manager_email" required>
                </div><br>
                <button type="submit" class="btn btn-primary">Import</button>
                <a href="{{ route('supermarkets.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
