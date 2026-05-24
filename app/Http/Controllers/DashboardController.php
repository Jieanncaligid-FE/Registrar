<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sectionId = $request->input('section_id');
        $adviser = $request->input('adviser');

        $students = Student::with(['section', 'grades.subject'])
            ->when($search, function ($query, $search) {
                $query->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('student_id_number', 'like', "%{$search}%");
                });
            })
            ->when($sectionId, fn($query) => $query->where('section_id', $sectionId))
            ->when($adviser, fn($query) => $query->whereHas('section', fn($q) => $q->where('adviser_name', $adviser)))
            ->paginate(10)
            ->withQueryString();

        $allStudents = Student::with(['section', 'grades'])->get();
        $totalStudents = $allStudents->count();
        $passCount = $allStudents->filter(fn($student) => $student->averageGrade() >= 75)->count();
        $failCount = $totalStudents - $passCount;
        $averagePerformance = $totalStudents ? round($allStudents->avg(fn($student) => $student->averageGrade()), 2) : 0;
        $sections = Section::orderBy('section_name')->get();
        $advisers = Section::orderBy('adviser_name')->pluck('adviser_name')->unique();

        return view('dashboard.index', compact(
            'students',
            'sections',
            'advisers',
            'passCount',
            'failCount',
            'averagePerformance',
            'totalStudents'
        ));
    }
}
