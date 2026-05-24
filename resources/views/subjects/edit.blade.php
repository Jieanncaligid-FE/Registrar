@extends('layouts.app')

@section('title', 'Edit Subject')
@section('page-title', 'Edit Subject')
@section('page-description', 'Update subject name and save changes.')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('subjects.update', $subject) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Subject Name</label>
                <input type="text" name="subject_name" value="{{ old('subject_name', $subject->subject_name) }}" class="form-control" required>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Subject</button>
            </div>
        </form>
    </div>
</div>
@endsection
