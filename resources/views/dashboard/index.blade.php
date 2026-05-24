@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of sections, students, and performance statistics.')

@section('content')
<div class="dashboard-cards">
    <div class="dashboard-card variant-1 card-soft">
        <small>Total Students</small>
        <h2>{{ $totalStudents }}</h2>
    </div>
    <div class="dashboard-card variant-2 card-soft">
        <small>Pass Count</small>
        <h2>{{ $passCount }}</h2>
    </div>
    <div class="dashboard-card variant-3 card-soft">
        <small>Fail Count</small>
        <h2>{{ $failCount }}</h2>
    </div>
    <div class="dashboard-card variant-4 card-soft">
        <small>Average Performance</small>
        <h2>{{ number_format($averagePerformance, 2) }}</h2>
    </div>
</div>

<div class="search-panel">
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-lg-5 col-md-12">
            <label class="form-label text-muted">Search</label>
            <input name="search" type="text" value="{{ request('search') }}" class="form-control" placeholder="Search student name or ID">
        </div>
        <div class="col-lg-3 col-md-6">
            <label class="form-label text-muted">Section</label>
            <select name="section_id" class="form-select">
                <option value="">All sections</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>{{ $section->section_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-6">
            <label class="form-label text-muted">Adviser</label>
            <select name="adviser" class="form-select">
                <option value="">All advisers</option>
                @foreach($advisers as $adviser)
                    <option value="{{ $adviser }}" {{ request('adviser') == $adviser ? 'selected' : '' }}>{{ $adviser }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-1 col-md-12 d-grid">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="table-card card-soft">
            <div class="card-header">Student Results</div>
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Adviser</th>
                            <th>Average</th>
                            <th>Remarks</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                                <td>{{ $student->student_id_number }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->section->section_name }}</td>
                                <td>{{ $student->section->adviser_name }}</td>
                                <td>{{ number_format($student->averageGrade(), 2) }}</td>
                                <td>
                                    <span class="badge {{ $student->averageGrade() >= 75 ? 'badge-success' : 'badge-danger' }}">{{ $student->remarks() }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center py-5">No students found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>

@endsection
