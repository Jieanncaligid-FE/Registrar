<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create(Section $section)
    {
        $subjects = Subject::orderBy('subject_name')->get();

        return view('students.create', compact('section', 'subjects'));
    }

    public function store(Request $request, Section $section)
    {
        $data = $request->validate([
            'student_id_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'grades' => 'array',
            'grades.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $student = $section->students()->create([
            'student_id_number' => $data['student_id_number'],
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
        ]);

        if (!empty($data['grades'])) {
            foreach ($data['grades'] as $subjectId => $grade) {
                if ($grade !== null && $grade !== '') {
                    Grade::create([
                        'student_id' => $student->id,
                        'subject_id' => $subjectId,
                        'grade' => $grade,
                    ]);
                }
            }
        }

        return redirect()->route('sections.show', $section)->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $student->load(['section', 'grades.subject']);

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $subjects = Subject::orderBy('subject_name')->get();
        $grades = $student->grades->keyBy('subject_id');

        return view('students.edit', compact('student', 'subjects', 'grades'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'student_id_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'grades' => 'array',
            'grades.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $student->update([
            'student_id_number' => $data['student_id_number'],
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
        ]);

        if (!empty($data['grades'])) {
            foreach ($data['grades'] as $subjectId => $grade) {
                if ($grade !== null && $grade !== '') {
                    Grade::updateOrCreate(
                        ['student_id' => $student->id, 'subject_id' => $subjectId],
                        ['grade' => $grade]
                    );
                } else {
                    Grade::where('student_id', $student->id)->where('subject_id', $subjectId)->delete();
                }
            }
        }

        return redirect()->route('students.show', $student)->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $section = $student->section;
        $student->delete();

        return redirect()->route('sections.show', $section)->with('success', 'Student removed successfully.');
    }
}
