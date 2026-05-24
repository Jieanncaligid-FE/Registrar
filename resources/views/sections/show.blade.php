@extends('layouts.app')

@section('title', 'Section Details')
@section('page-title', 'Section Details')
@section('page-description', 'View section information, students, and ranking.')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Section Information</h5>
                <p><strong>Section:</strong> {{ $section->section_name }}</p>
                <p><strong>Adviser:</strong> {{ $section->adviser_name }}</p>
                <p><strong>Total Students:</strong> {{ $section->students->count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 text-end align-self-end">
        <a href="{{ route('sections.students.create', $section) }}" class="btn btn-primary">Add Student</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">Student List</div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Average</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->student_id_number }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ number_format($student->average, 2) }}</td>
                                <td>
                                    <span class="badge {{ $student->average >= 75 ? 'bg-success' : 'bg-danger' }}">{{ $student->remarks() }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline-block" onsubmit="return confirm('Remove this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">No students in this section yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">Rankings</div>
            <div class="list-group list-group-flush">
                @forelse($students as $student)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Rank {{ $loop->iteration }}</strong>
                            <div>{{ $student->name }}</div>
                        </div>
                        <span class="badge bg-primary">{{ number_format($student->average, 2) }}</span>
                    </div>
                @empty
                    <div class="list-group-item text-center">No ranking available yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
