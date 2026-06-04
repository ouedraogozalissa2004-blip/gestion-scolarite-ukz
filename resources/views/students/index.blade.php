<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Élèves</title>
    <style>
        /* Barre de navigation globale */
        .navbar { background-color: #333; overflow: hidden; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .navbar a { float: left; color: #f2f2f2; text-align: center; padding: 10px 16px; text-decoration: none; font-weight: bold; }
        .navbar a:hover { background-color: #ddd; color: black; border-radius: 4px; }
        .navbar a.active { background-color: #04AA6D; color: white; border-radius: 4px; }

        /* Styles de la table et des boutons */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; vertical-align: middle; }
        th { background-color: #f4f4f4; text-transform: uppercase; font-size: 13px; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; display: inline-block; font-size: 14px; }
        .btn-add { background-color: green; color: white; margin-bottom: 10px; }
        .btn-report { background-color: #5c6bc0; color: white; }
        .btn-edit { background-color: orange; color: white; }
        .btn-delete { background-color: red; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <!-- Barre de navigation commune avec l'ajout du tableau de bord -->
    <div class="navbar">
        <a href="{{ url('/') }}">🏠 Accueil</a>
        <a href="{{ route('classrooms.index') }}">🏫 Classes</a>
        <a href="{{ route('students.index') }}" class="active">👨‍🎓 Élèves</a>
        <a href="{{ route('subjects.index') }}">📚 Matières</a>
        <a href="{{ route('grades.index') }}">📝 Notes</a>
        <a href="{{ route('payments.index') }}">💰 Paiements</a>
        <a href="{{ url('/dashboard') }}">📊 Tableau de Bord</a>
    </div>

    <h1>Liste des Élèves</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('students.create') }}" class="btn btn-add">Inscrire un nouvel élève</a>

    <table>
        <thead>
            <tr>
                <th>Photo</th> 
                <th>Prénom</th>
                <th>Nom</th>
                <th>Classe</th>
                <th>Moyenne Générale</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <!-- Correction affichage photo / avatar -->
                    <td style="text-align: center; width: 60px;">
                        @if($student->photo_path && file_exists(public_path('storage/' . $student->photo_path)))
                            <img src="{{ asset('storage/' . $student->photo_path) }}" alt="Photo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                        @else
                            <span style="font-size: 20px; display: block;">👤 Photo</span>
                        @endif
                    </td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->classroom->name ?? 'Non définie' }}</td>
                    
                    <!-- Correction : Suppression du "/ 20" écrit en dur car le modèle fournit déjà le bon barème sur 10 -->
                    <td><strong>{{ $student->averageScore() }}</strong></td>
                    
                    <td>
                        <!-- Bouton d'accès au Bulletin -->
                        <a href="{{ route('students.report_card', $student->id) }}" class="btn btn-report">Bulletin</a>

                        <!-- Bouton Modifier -->
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-edit">Modifier</a>
                        
                        <!-- Formulaire Supprimer -->
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cet élève ?');">
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
