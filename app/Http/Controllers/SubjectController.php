<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::orderBy('subject_name')->paginate(10);
        $selectedSubject = null;
        $subjectGrades = collect();

        if ($request->filled('subject_id')) {
            $selectedSubject = Subject::with(['grades.student.section'])->find($request->input('subject_id'));
            if ($selectedSubject) {
                $subjectGrades = $selectedSubject->grades()->with('student.section')->get();
            }
        }

        return view('subjects.index', compact('subjects', 'selectedSubject', 'subjectGrades'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255|unique:subjects,subject_name',
        ]);

        Subject::create($request->only('subject_name'));

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255|unique:subjects,subject_name,' . $subject->id,
        ]);

        $subject->update($request->only('subject_name'));

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
