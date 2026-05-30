<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index() {
        $subjects = Subject::with('classroom')->get();
        return view('subjects.index', compact('subjects'));
    }

    public function create() {
        // Va chercher TOUTES les classes de la base de données
        $classrooms = Classroom::all();
        
        // Envoie la variable à la vue
        return view('subjects.create', compact('classrooms'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);
        Subject::create($validated);
        return redirect()->route('subjects.index')->with('success', 'Matière ajoutée à la classe !');
    }

    public function edit(Subject $subject) {
        $classrooms = Classroom::all();
        return view('subjects.edit', compact('subject', 'classrooms'));
    }

    public function update(Request $request, Subject $subject) {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);
        $subject->update($validated);
        return redirect()->route('subjects.index')->with('success', 'Matière modifiée !');
    }

    public function destroy(Subject $subject) {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Matière supprimée !');
    }
}
