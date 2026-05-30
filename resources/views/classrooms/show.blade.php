<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la classe {{ $classroom->name }}</title>
    <style>
        /* Barre de navigation globale */
        .navbar { background-color: #333; overflow: hidden; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .navbar a { float: left; color: #f2f2f2; text-align: center; padding: 10px 16px; text-decoration: none; font-weight: bold; }
        .navbar a:hover { background-color: #ddd; color: black; border-radius: 4px; }
        .navbar a.active { background-color: #04AA6D; color: white; border-radius: 4px; }

        /* Styles de la page */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; text-transform: uppercase; font-size: 13px; }
        .badge-grade { background-color: #e3f2fd; padding: 3px 6px; border-radius: 4px; display: inline-block; margin: 2px; font-size: 0.9em; }
        .btn-back { background-color: gray; color: white; padding: 10px 15px; text-decoration: none; border-radius: 3px; display: inline-block; margin-top: 20px; }
        .rank-first { color: #d4af37; font-weight: bold; font-size: 1.1rem; } /* Style pour le 1er */
    </style>
</head>
<body>

    <!-- Barre de navigation commune -->
    <div class="navbar">
        <a href="{{ url('/') }}">🏠 Accueil</a>
        <a href="{{ route('classrooms.index') }}" class="active">🏫 Classes</a>
        <a href="{{ route('students.index') }}">👨‍🎓 Élèves</a>
        <a href="{{ route('subjects.index') }}">📚 Matières</a>
        <a href="{{ route('grades.index') }}">📝 Notes</a>
        <a href="{{ route('payments.index') }}">💰 Paiements</a>
        <a href="{{ url('/dashboard') }}">📊 Tableau de Bord</a>
    </div>

    <h1>Classe : {{ $classroom->name }}</h1>
    <p><strong>Frais de scolarité de base :</strong> {{ number_format($classroom->tuition_fee, 0, ',', ' ') }} FCFA</p>
    <p><strong>Moyenne générale de la classe :</strong> {{ $classroom->classroomAverage() }} / 20</p>

    <h2>Classement et Rangs des Élèves</h2>

    <table>
        <thead>
            <tr>
                <th>Rang</th> <!-- Nouvelle colonne Rang -->
                <th>Élève</th>
                <th>Notes par Matière</th>
                <th>Moyenne</th>
                <th>Statut Scolarité</th>
            </tr>
        </thead>
        <tbody>
            @php $rank = 1; @endphp
            @forelse($sortedStudents as $student)
                <tr>
                    <!-- Affichage dynamique du rang -->
                    <td class="{{ $rank == 1 ? 'rank-first' : '' }}">
                        @if($student->averageScore() === 'N/A')
                            -
                        @else
                            {{ $rank == 1 ? '🥇 1er' : $rank . 'e' }}
                            @php $rank++; @endphp
                        @endif
                    </td>
                    <td><strong>{{ $student->last_name }} {{ $student->first_name }}</strong></td>
                    <td>
                        @forelse($student->grades as $grade)
                            <span class="badge-grade">
                                {{ $grade->subject->name ?? 'Matière' }} (T{{ $grade->quarter }}) : <strong>{{ $grade->score }}</strong>/20
                            </span>
                        @empty
                            <small style="color: gray;">Aucune note saisie</small>
                        @endforelse
                    </td>
                    <td><strong>{{ $student->averageScore() }}</strong> / 20</td>
                    <td>{!! $student->tuitionStatus() !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: gray;">Aucun élève inscrit dans cette classe pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('classrooms.index') }}" class="btn-back">Retour à la liste des classes</a>

</body>
</html>
