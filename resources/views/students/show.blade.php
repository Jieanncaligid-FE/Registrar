@extends('layouts.app')

@section('title', 'Student Details')
@section('page-title', 'Student Details')
@section('page-description', 'View the student record, grades, average, and remarks.')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Student Information</h5>
                <p><strong>ID Number:</strong> {{ $student->student_id_number }}</p>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Email:</strong> {{ $student->email ?? 'N/A' }}</p>
                <p><strong>Section:</strong> {{ $student->section->section_name }}</p>
                <p><strong>Adviser:</strong> {{ $student->section->adviser_name }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Performance</h5>
                <p><strong>Average Grade:</strong> {{ number_format($student->averageGrade(), 2) }}</p>
                <p><strong>Remarks:</strong>
                    <span class="badge {{ $student->averageGrade() >= 75 ? 'bg-success' : 'bg-danger' }}">{{ $student->remarks() }}</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Subject Grades</div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @forelse($student->grades as $grade)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $grade->subject->subject_name }}</td>
                        <td>{{ number_format($grade->grade, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">No grades recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-end">
    <a href="{{ route('sections.show', $student->section) }}" class="btn btn-secondary">Back to Section</a>
</div>
@endsection
