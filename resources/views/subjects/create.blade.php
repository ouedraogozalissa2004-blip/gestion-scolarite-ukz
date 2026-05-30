<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une matière</title>
    <style>
        .form-group { margin-bottom: 15px; font-family: sans-serif; }
        label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 1.2rem; }
        input, select { width: 100%; padding: 10px; box-sizing: border-box; font-size: 1rem; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 10px 15px; color: white; border: none; cursor: pointer; text-decoration: none; border-radius: 3px; font-size: 1rem; display: inline-block; }
        .btn-submit { background-color: green; }
        .btn-back { background-color: gray; margin-left: 10px; }
    </style>
</head>
<body>

    <h1>Ajouter une nouvelle matière</h1>

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nom de la matière</label>
            <input type="text" name="name" id="name" placeholder="Ex: Opération, Dictée..." required>
        </div>

        <div class="form-group">
            <label for="classroom_id">Assigner à une Classe</label>
            <select name="classroom_id" id="classroom_id" required>
                <option value="">-- Choisir une classe --</option>
                <!-- La boucle indispensable pour afficher vos classes existantes -->
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-submit">Enregistrer la matière</button>
            <a href="{{ route('subjects.index') }}" class="btn btn-back">Retour</a>
        </div>
    </form>

</body>
</html>
