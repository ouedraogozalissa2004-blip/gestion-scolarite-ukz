<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscrire un élève - École La Grâce</title>
    <style>
        .form-group { margin-bottom: 15px; font-family: sans-serif; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; border-radius: 4px; border: 1px solid #ccc; }
        .btn { padding: 10px 15px; color: white; border: none; cursor: pointer; text-decoration: none; border-radius: 3px; display: inline-block; }
        .btn-submit { background-color: green; }
        .btn-back { background-color: gray; margin-left: 10px; }
    </style>
</head>
<body>

    <h1>Inscrire un nouvel élève</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- AJOUT OBLIGATOIRE : enctype pour gérer les fichiers/photos -->
    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="first_name">Prénom</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Nom</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
        </div>

        <div class="form-group">
            <label for="classroom_id">Classe</label>
            <select name="classroom_id" id="classroom_id" required>
                <option value="">-- Sélectionner une classe --</option>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- AJOUT : Champ pour la photo de l'élève -->
        <div class="form-group">
            <label for="photo">Photo de profil de l'élève (Optionnel)</label>
            <input type="file" name="photo" id="photo" accept="image/*">
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-submit">Enregistrer l'élève</button>
            <a href="{{ route('students.index') }}" class="btn btn-back">Retour</a>
        </div>
    </form>

</body>
</html>
