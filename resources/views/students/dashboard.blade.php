<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Global - École La Grâce</title>
    <style>
        /* Barre de navigation globale */
        .navbar { background-color: #333; overflow: hidden; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .navbar a { float: left; color: #f2f2f2; text-align: center; padding: 10px 16px; text-decoration: none; font-weight: bold; }
        .navbar a:hover { background-color: #ddd; color: black; border-radius: 4px; }
        .navbar a.active { background-color: #04AA6D; color: white; border-radius: 4px; }

        /* Grille des statistiques */
        .stats-grid { display: flex; gap: 20px; margin-bottom: 30px; margin-top: 20px; }
        .card { flex: 1; padding: 25px; border-radius: 8px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-expected { background-color: #2b5797; }
        .card-collected { background-color: #00a300; }
        .card-remaining { background-color: #b91d47; }
        .card h3 { margin-top: 0; font-size: 1.1rem; opacity: 0.9; text-transform: uppercase; }
        .card p { font-size: 1.8rem; font-weight: bold; margin-bottom: 0; }

        /* Styles des tableaux */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 40px; }
        th, td { border: 1px solid #ccc; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; text-transform: uppercase; font-size: 13px; }
        .status-debt { background-color: #ffebee; color: #c62828; padding: 4px 8px; border-radius: 4px; font-weight: bold; display: inline-block; }
        h2 { border-left: 5px solid #b91d47; padding-left: 10px; color: #333; font-family: sans-serif; }
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
        <a href="{{ route('payments.index') }}">💰 Paiements</a>
        <a href="{{ url('/dashboard') }}" class="active">📊 Tableau de Bord</a>
    </div>

    <h1 style="font-family: sans-serif;">Tableau de Bord Global Administratif</h1>

    <!-- 📊 Zone des cartes statistiques financières -->
    <div class="stats-grid">
        <div class="card card-expected">
            <h3>Frais Attendus Globaux</h3>
            <p>{{ number_format($totalExpected, 0, ',', ' ') }} FCFA</p>
        </div>
        <div class="card card-collected">
            <h3>Frais Collectés (Encaissés)</h3>
            <p>{{ number_format($totalCollected, 0, ',', ' ') }} FCFA</p>
        </div>
        <div class="card card-remaining">
            <h3>Total Restant à Recouvrer</h3>
            <p>{{ number_format($totalExpected - $totalCollected, 0, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <!-- ⚠️ Zone de la liste des élèves en retard de paiement -->
    <h2>Liste des Élèves en Retard de Paiement (Impayés)</h2>
    <table>
        <thead>
            <tr>
                <th>Nom & Prénom de l'Élève</th>
                <th>Classe</th>
                <th>Frais de Scolarité</th>
                <th>Montant déjà Versé</th>
                <th>Reste à Payer</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lateStudents as $student)
                <tr>
                    <td><strong>{{ $student->last_name }} {{ $student->first_name }}</strong></td>
                    <td>{{ $student->classroom->name ?? 'Non définie' }}</td>
                    <td>{{ number_format($student->classroom->tuition_fee ?? 0, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($student->total_paid, 0, ',', ' ') }} FCFA</td>
                    <td style="color: #c62828; font-weight: bold;">{{ number_format($student->remaining_balance, 0, ',', ' ') }} FCFA</td>
                    <td><span class="status-debt">En Retard</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: green; font-weight: bold; padding: 20px;">
                        🎉 Félicitations ! Tous les élèves sont à jour de leur scolarité.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
