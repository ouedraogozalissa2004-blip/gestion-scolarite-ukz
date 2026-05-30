<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la matière</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; color: white; border: none; cursor: pointer; text-decoration: none; border-radius: 3px; }
        .btn-submit { background-color: orange; }
        .btn-back { background-color: gray; }
    </style>
</head>
<body>
    <h1>Modifier la matière</h1>

    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom de la matière</label>
            <input type="text" name="name" id="name" value="{{ $subject->name }}" required>
        </div>

        <div class="form-group">
            <label for="classroom_id">Changer de Classe</label>
            <select name="classroom_id" id="classroom_id" required>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ $subject->classroom_id == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-submit">Mettre à jour</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-back">Retour</a>
    </form>
</body>
</html>
