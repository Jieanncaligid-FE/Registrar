@extends('layouts.app')

@section('title', 'Add Student')
@section('page-title', 'Add Student')
@section('page-description')
    Add a student to {{ $section->section_name }} and enter grades.
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('sections.students.store', $section) }}">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Student ID Number</label>
                    <input type="text" name="student_id_number" value="{{ old('student_id_number') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Student Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>

            <div class="mb-4">
                <h5 class="mb-3">Grades</h5>
                @if($subjects->isEmpty())
                    <div class="alert alert-warning">Add subjects first before entering grades.</div>
                @endif
                <div class="row g-3">
                    @foreach($subjects as $subject)
                        <div class="col-md-6">
                            <label class="form-label">{{ $subject->subject_name }}</label>
                            <input type="number" step="0.01" min="0" max="100" name="grades[{{ $subject->id }}]" value="{{ old('grades.' . $subject->id) }}" class="form-control">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('sections.show', $section) }}" class="btn btn-secondary me-2">Back</a>
                <button type="submit" class="btn btn-primary">Save Student</button>
            </div>
        </form>
    </div>
</div>
@endsection
