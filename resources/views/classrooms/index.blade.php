<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Classes</title>
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
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; display: inline-block; }
        .btn-add { background-color: green; color: white; margin-bottom: 10px; }
        .btn-edit { background-color: orange; color: white; }
        .btn-delete { background-color: red; color: white; border: none; cursor: pointer; }
        .class-link { font-weight: bold; color: #0056b3; text-decoration: underline; }
        .class-link:hover { color: #003d82; }
    </style>
</head>
<body>

    <!-- Barre de navigation commune mise à jour -->
    <div class="navbar">
        <a href="{{ url('/') }}">🏠 Accueil</a>
        <a href="{{ route('classrooms.index') }}" class="active">🏫 Classes</a>
        <a href="{{ route('students.index') }}">👨‍🎓 Élèves</a>
        <a href="{{ route('subjects.index') }}">📚 Matières</a>
        <a href="{{ route('grades.index') }}">📝 Notes</a>
        <a href="{{ route('payments.index') }}">💰 Paiements</a>
        <a href="{{ url('/dashboard') }}">📊 Tableau de Bord</a>
    </div>

    <h1>Gestion des Classes</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('classrooms.create') }}" class="btn btn-add">Créer une classe</a>

    <table>
        <thead>
            <tr>
                <th>Nom de la classe</th>
                <th>Frais de scolarité (FCFA)</th>
                <th>Moyenne de la classe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classrooms as $classroom)
                <tr>
                    <td>
                        <!-- Nom de la classe devenu cliquable -->
                        <a href="{{ route('classrooms.show', $classroom->id) }}" class="class-link">
                            {{ $classroom->name }}
                        </a>
                    </td>
                    <td>{{ number_format($classroom->tuition_fee, 0, ',', ' ') }} FCFA</td>
                    <td>
                        <strong>{{ $classroom->classroomAverage() }}</strong> / 20
                    </td>
                    <td>
                        <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-edit">Modifier</a>
                        <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette classe ?');">
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
