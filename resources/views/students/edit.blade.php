@extends('layouts.app')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student')
@section('page-description', 'Update student information and grades.')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Student ID Number</label>
                    <input type="text" name="student_id_number" value="{{ old('student_id_number', $student->student_id_number) }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Student Name</label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $student->email) }}" class="form-control">
            </div>

            <div class="mb-4">
                <h5 class="mb-3">Grades</h5>
                <div class="row g-3">
                    @forelse($subjects as $subject)
                        <div class="col-md-6">
                            <label class="form-label">{{ $subject->subject_name }}</label>
                            <input type="number" step="0.01" min="0" max="100" name="grades[{{ $subject->id }}]" value="{{ old('grades.' . $subject->id, optional($grades->get($subject->id))->grade) }}" class="form-control">
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning">Add subjects first before editing grades.</div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('students.show', $student) }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
    </div>
</div>
@endsection
