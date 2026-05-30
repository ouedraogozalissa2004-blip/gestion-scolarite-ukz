<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une classe</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; color: white; border: none; cursor: pointer; text-decoration: none; border-radius: 3px; }
        .btn-submit { background-color: green; }
        .btn-back { background-color: gray; }
    </style>
</head>
<body>
    <h1>Créer une nouvelle classe</h1>

    <form action="{{ route('classrooms.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom de la classe (ex: CP1, CM2)</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="tuition_fee">Frais de Scolarité</label>
            <input type="number" name="tuition_fee" id="tuition_fee" min="0" required>
        </div>
        <button type="submit" class="btn btn-submit">Enregistrer la classe</button>
        <a href="{{ route('classrooms.index') }}" class="btn btn-back">Retour</a>
    </form>
</body>
</html>
