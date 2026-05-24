@extends('layouts.app')

@section('title', 'Sections')
@section('page-title', 'Sections')
@section('page-description', 'Manage sections, advisers, and access student lists.')

@section('content')
<div class="mb-4 text-end">
    <a href="{{ route('sections.create') }}" class="btn btn-primary">Add Section</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Section</th>
                        <th>Adviser</th>
                        <th>Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $section)
                        <tr>
                            <td>{{ $loop->iteration + ($sections->currentPage() - 1) * $sections->perPage() }}</td>
                            <td>{{ $section->section_name }}</td>
                            <td>{{ $section->adviser_name }}</td>
                            <td>{{ $section->students_count }}</td>
                            <td>
                                <a href="{{ route('sections.show', $section) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('sections.edit', $section) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form method="POST" action="{{ route('sections.destroy', $section) }}" class="d-inline-block" onsubmit="return confirm('Delete this section?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">No sections created yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $sections->links() }}</div>
</div>
@endsection
