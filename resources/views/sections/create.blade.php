@extends('layouts.app')

@section('title', 'Add Section')
@section('page-title', 'Add Section')
@section('page-description', 'Create a new section and assign an adviser.')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('sections.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Section Name</label>
                <input type="text" name="section_name" value="{{ old('section_name') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adviser Name</label>
                <input type="text" name="adviser_name" value="{{ old('adviser_name') }}" class="form-control" required>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('sections.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Section</button>
            </div>
        </form>
    </div>
</div>
@endsection
