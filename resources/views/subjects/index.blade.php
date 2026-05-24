@extends('layouts.app')

@section('title', 'Subjects')
@section('page-title', 'Subjects')
@section('page-description', 'Add, edit, delete subjects and view grades by subject filter.')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">Add Subject</a>
    </div>
    <div class="col-md-6">
        <form method="GET" class="d-flex">
            <select name="subject_id" class="form-select me-2">
                <option value="">Select subject to view grades</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ optional($selectedSubject)->id == $subject->id ? 'selected' : '' }}>{{ $subject->subject_name }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-primary">View Grades</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Subject List</div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Subject Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration + ($subjects->currentPage() - 1) * $subjects->perPage() }}</td>
                        <td>{{ $subject->subject_name }}</td>
                        <td>
                            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="{{ route('subjects.destroy', $subject) }}" class="d-inline-block" onsubmit="return confirm('Delete this subject?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">No subjects yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $subjects->links() }}</div>
</div>

@if($selectedSubject)
    <div class="card">
        <div class="card-header">Grades for {{ $selectedSubject->subject_name }}</div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Adviser</th>
                        <th>Grade</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjectGrades as $grade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grade->student->student_id_number }}</td>
                            <td>{{ $grade->student->name }}</td>
                            <td>{{ $grade->student->section->section_name }}</td>
                            <td>{{ $grade->student->section->adviser_name }}</td>
                            <td>{{ number_format($grade->grade, 2) }}</td>
                            <td><a href="{{ route('students.show', $grade->student) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">No grades recorded for this subject.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
