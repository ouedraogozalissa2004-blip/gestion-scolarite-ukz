<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index() {
        $classrooms = Classroom::all();
        return view('classrooms.index', compact('classrooms'));
    }

    public function create() {
        return view('classrooms.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tuition_fee' => 'required|numeric|min:0', // Corrigé ici
        ]);
        Classroom::create($validated);
        return redirect()->route('classrooms.index')->with('success', 'Classe créée !');
    }

    // CORRECTION : Affiche les détails d'une classe avec classement par rang
    public function show(Classroom $classroom)
    {
        // 1. Charge la classe avec toutes ses relations d'un seul coup
        $classroom->load(['students.grades.subject', 'students.payments']);

        // 2. Trie les élèves par moyenne générale décroissante
        $sortedStudents = $classroom->students->sortByDesc(function ($student) {
            $avg = $student->grades->avg('score');
            // Si l'élève n'a aucune note, on renvoie -1 pour le placer à la fin du classement
            return $avg !== null ? $avg : -1;
        });

        // 3. Envoie la classe et la liste triée à la vue show.blade.php
        return view('classrooms.show', compact('classroom', 'sortedStudents'));
    }

    public function edit(Classroom $classroom) {
        return view('classrooms.edit', compact('classroom'));
    }

    public function update(Request $request, Classroom $classroom) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tuition_fee' => 'required|numeric|min:0', // Corrigé ici
        ]);
        $classroom->update($validated);
        return redirect()->route('classrooms.index')->with('success', 'Classe mise à jour !');
    }

    public function destroy(Classroom $classroom) {
        $classroom->delete();
        return redirect()->route('classrooms.index')->with('success', 'Classe supprimée !');
    }
}
