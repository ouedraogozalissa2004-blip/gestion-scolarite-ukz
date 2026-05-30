<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Paiements</title>
    <style>
        /* Barre de navigation globale */
        .navbar { background-color: #333; overflow: hidden; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .navbar a { float: left; color: #f2f2f2; text-align: center; padding: 10px 16px; text-decoration: none; font-weight: bold; }
        .navbar a:hover { background-color: #ddd; color: black; border-radius: 4px; }
        .navbar a.active { background-color: #04AA6D; color: white; border-radius: 4px; }

        /* Styles de la table et des boutons */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; display: inline-block; font-size: 14px; }
        .btn-add { background-color: green; color: white; margin-bottom: 10px; }
        .btn-edit { background-color: orange; color: white; }
        .btn-print { background-color: #0056b3; color: white; }
        .btn-delete { background-color: red; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <!-- Barre de navigation commune -->
    <div class="navbar">
        <a href="{{ url('/') }}">🏠 Accueil</a>
        <a href="{{ route('classrooms.index') }}">🏫 Classes</a>
        <a href="{{ route('students.index') }}">👨‍🎓 Élèves</a>
        <a href="{{ route('subjects.index') }}">📚 Matières</a>
        <a href="{{ route('grades.index') }}">📝 Notes</a>
        <a href="{{ route('payments.index') }}" class="active">💰 Paiements</a>
    </div>

    <h1>Historique des Versements</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('payments.create') }}" class="btn btn-add">Enregistrer un versement</a>

    <table>
        <thead>
            <tr>
                <th>Élève</th>
                <th>Classe</th> <!-- Nouvelle colonne -->
                <th>Montant Versé</th>
                <th>Reste à Payer</th> <!-- Nouvelle colonne -->
                <th>Date du reçu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->student->first_name ?? '' }} {{ $payment->student->last_name ?? 'Inconnu' }}</td>
                    
                    <!-- Affichage de la classe -->
                    <td><strong>{{ $payment->student->classroom->name ?? 'Non définie' }}</strong></td>
                    
                    <td>{{ number_format($payment->amount_paid, 0, ',', ' ') }} FCFA</td>
                    
                    <!-- Affichage du reste à payer en direct grâce au modèle Student -->
                    <td>
                        @if($payment->student)
                            @php
                                $totalCost = $payment->student->classroom->tuition_fee ?? 0;
                                $paid = $payment->student->totalPaid();
                                $remaining = $totalCost - $paid;
                            @endphp
                            
                            @if($remaining <= 0)
                                <span style="color: green; font-weight: bold;">Soldé</span>
                            @else
                                <span style="color: red; font-weight: bold;">{{ number_format($remaining, 0, ',', ' ') }} FCFA</span>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    
                    <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('payments.print', $payment->id) }}" class="btn btn-print">Imprimer</a>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-edit">Modifier</a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Annuler ce versement ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
