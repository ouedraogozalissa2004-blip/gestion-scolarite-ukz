<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        // CORRECTION : On charge l'élève et sa classe associée pour pouvoir faire les calculs financiers
        $payments = Payment::with('student.classroom')->get();
        return view('payments.index', compact('payments'));
    }

    public function create() {
        $students = Student::all();
        return view('payments.create', compact('students'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        // On ajoute automatiquement la date et l'heure actuelles
        $validated['payment_date'] = now();

        Payment::create($validated);
        return redirect()->route('payments.index')->with('success', 'Versement enregistré !');
    }

    public function edit(Payment $payment) {
        $students = Student::all();
        return view('payments.edit', compact('payment', 'students'));
    }

    public function update(Request $request, Payment $payment) {
        $validated = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        // On met à jour la date avec la date actuelle
        $validated['payment_date'] = now();

        $payment->update($validated);
        return redirect()->route('payments.index')->with('success', 'Versement modifié !');
    }

    public function destroy(Payment $payment) {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Versement supprimé !');
    }

    // Action pour afficher la page d'impression du reçu
    public function print(Payment $payment)
    {
        // Charge l'élève et sa classe pour avoir toutes les infos sur le reçu
        $payment->load('student.classroom');
        return view('payments.print', compact('payment'));
    }
}
