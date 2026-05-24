@extends('layouts.app')

@section('title', 'Add Subject')
@section('page-title', 'Add Subject')
@section('page-description', 'Create a new subject to assign grades.')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('subjects.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Subject Name</label>
                <input type="text" name="subject_name" value="{{ old('subject_name') }}" class="form-control" required>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Subject</button>
            </div>
        </form>
    </div>
</div>
@endsection
