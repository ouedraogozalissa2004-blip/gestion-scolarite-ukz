<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Notes</title>
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
        <a href="{{ route('grades.index') }}" class="active">📝 Notes</a>
        <a href="{{ route('payments.index') }}">💰 Paiements</a>
    </div>

    <h1>Gestion des Notes</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('grades.create') }}" class="btn btn-add">Saisir une note</a>

    <table>
        <thead>
            <tr>
                <th>Élève</th>
                <th>Classe</th> <!-- Nouvelle colonne ajoutée -->
                <th>Matière</th>
                <!-- MODIFIÉ ICI : Note / 10 -->
                <th>Note / 10</th>
                <th>Trimestre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->student->first_name ?? '' }} {{ $grade->student->last_name ?? 'Inconnu' }}</td>
                    <td>
                        <!-- Affichage magique de la classe de l'élève -->
                        <span style="font-weight: bold; color: #0056b3;">
                            {{ $grade->student->classroom->name ?? 'Non définie' }}
                        </span>
                    </td>
                    <td>{{ $grade->subject->name ?? 'Inconnue' }}</td>
                    <!-- MODIFIÉ ICI : Affichage / 10 -->
                    <td><strong>{{ $grade->score }}</strong> / 10</td>
                    <td>Trimestre {{ $grade->quarter }}</td>
                    <td>
                        <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-edit">Modifier</a>
                        <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette note ?');">
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
