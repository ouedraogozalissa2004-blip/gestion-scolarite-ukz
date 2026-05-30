<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\Payment;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Afficher la liste des élèves
    public function index()
    {
        // On charge la relation classroom pour éviter les requêtes inutiles
        $students = Student::with('classroom')->get();
        return view('students.index', compact('students'));
    }

    // Afficher le formulaire d'inscription
    public function create()
    {
        // On récupère toutes les classes pour le menu déroulant du formulaire
        $classrooms = Classroom::all();
        return view('students.create', compact('classrooms'));
    }

    // Enregistrer un nouvel élève
    public function store(Request $request)
    {
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Élève inscrit avec succès !');
    }

    // Afficher le formulaire de modification
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        return view('students.edit', compact('student', 'classrooms'));
    }

    // Mettre à jour les informations d'un élève
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Informations de l\'élève mises à jour !');
    }

    // Supprimer un élève
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Élève supprimé de la base de données.');
    }

    // ÉTAPE 1 COMPLÈTE : Afficher le tableau de bord de la scolarité globale et des impayés
    public function dashboard()
    {
        // 1. Calculs statistiques pour les cartes financières
        $totalExpected = 0;
        $classrooms = Classroom::with('students')->get();
        
        foreach ($classrooms as $classroom) {
            // Frais attendus = Nombre d'élèves dans la classe * Frais de scolarité de cette classe
            $totalExpected += $classroom->students->count() * $classroom->tuition_fee;
        }

        // Frais collectés = Somme de tous les versements en base de données
        $totalCollected = Payment::sum('amount_paid');

        // 2. Traitement des données élèves pour extraire uniquement les retards de paiement
        $students = Student::with(['classroom', 'payments'])->get();
        $lateStudents = []; 

        foreach ($students as $student) {
            $tuitionFee = $student->classroom->tuition_fee ?? 0;
            $totalPaid = $student->payments->sum('amount_paid');
            
            $student->total_paid = $totalPaid;
            $student->remaining_balance = $tuitionFee - $totalPaid;

            // Si l'élève doit encore de l'argent, on l'ajoute à la liste des retards
            if ($student->remaining_balance > 0) {
                $lateStudents[] = $student;
            }
        }

        return view('students.dashboard', compact('students', 'lateStudents', 'totalExpected', 'totalCollected'));
    }

    // Générer et afficher le bulletin de notes de l'élève
    public function reportCard(Student $student, Request $request)
    {
        // Par défaut, on prend le Trimestre 1 si aucun n'est choisi
        $quarter = $request->get('quarter', 1);

        // Charge l'élève avec sa classe, ses notes du trimestre choisi et les matières associées
        $student->load(['classroom', 'grades' => function($query) use ($quarter) {
            $query->where('quarter', $quarter)->with('subject');
        }]);

        return view('students.report_card', compact('student', 'quarter'));
    }
}
