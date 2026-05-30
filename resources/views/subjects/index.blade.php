<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Matières</title>
    <style>
        .navbar { background-color: #333; overflow: hidden; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .navbar a { float: left; color: #f2f2f2; text-align: center; padding: 10px 16px; text-decoration: none; font-weight: bold; }
        .navbar a:hover { background-color: #ddd; color: black; border-radius: 4px; }
        .navbar a.active { background-color: #04AA6D; color: white; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; display: inline-block; }
        .btn-add { background-color: green; color: white; margin-bottom: 10px; }
        .btn-edit { background-color: orange; color: white; }
        .btn-delete { background-color: red; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="{{ route('classrooms.index') }}">🏫 Classes</a>
        <a href="{{ route('students.index') }}">👨‍🎓 Élèves</a>
        <a href="{{ route('subjects.index') }}" class="active">📚 Matières</a>
        <a href="{{ route('grades.index') }}">📝 Notes</a>
        <a href="{{ route('payments.index') }}">💰 Paiements</a>
    </div>

    <h1>Gestion des Matières par Classe</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('subjects.create') }}" class="btn btn-add">Ajouter une matière</a>

    <table>
        <thead>
            <tr>
                <th>Nom de la matière</th>
                <th>Classe concernée</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td><strong>{{ $subject->classroom->name ?? 'Aucune' }}</strong></td>
                    <td>
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-edit">Modifier</a>
                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette matière ?');">
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
