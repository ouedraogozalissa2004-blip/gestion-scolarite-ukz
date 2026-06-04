<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index() {
        // AJOUT : On charge l'élève, sa classe associée, et la matière de la note
        $grades = Grade::with(['student.classroom', 'subject'])->get();
        return view('grades.index', compact('grades'));
    }

    public function create() {
        // Charge les élèves avec leur classe et les matières associées à cette classe
        $students = Student::with('classroom.subjects')->get();
        // Charge toutes les matières avec leur classe pour le filtrage
        $subjects = Subject::with('classroom')->get();
        
        return view('grades.create', compact('students', 'subjects'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score'      => 'required|numeric|min:0|max:10', // Modifié ici : max 10
            'quarter'    => 'required|integer|between:1,3',
        ]);
        
        Grade::create($validated);
        return redirect()->route('grades.index')->with('success', 'Note enregistrée !');
    }

    public function edit(Grade $grade) {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    public function update(Request $request, Grade $grade) {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score'      => 'required|numeric|min:0|max:10', // Modifié ici : max 10
            'quarter'    => 'required|integer|between:1,3',
        ]);
        
        $grade->update($validated);
        return redirect()->route('grades.index')->with('success', 'Note mise à jour !');
    }

    public function destroy(Grade $grade) {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Note supprimée !');
    }
}
