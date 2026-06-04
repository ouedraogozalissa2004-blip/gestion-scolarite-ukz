<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la note</title>
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
    <h1>Modifier la note</h1>

    <form action="{{ route('grades.update', $grade->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="student_id">Élève</label>
            <select name="student_id" id="student_id" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $grade->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subject_id">Matière</label>
            <select name="subject_id" id="subject_id" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $grade->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quarter">Trimestre</label>
            <select name="quarter" id="quarter" required>
                <option value="1" {{ $grade->quarter == 1 ? 'selected' : '' }}>Trimestre 1</option>
                <option value="2" {{ $grade->quarter == 2 ? 'selected' : '' }}>Trimestre 2</option>
                <option value="3" {{ $grade->quarter == 3 ? 'selected' : '' }}>Trimestre 3</option>
            </select>
        </div>

        <div class="form-group">
            <!-- MODIFIÉ ICI : Changement du texte (Sur 10) et du max="10" -->
            <label for="score">Note (Sur 10)</label>
            <input type="number" name="score" id="score" value="{{ $grade->score }}" min="0" max="10" step="0.25" required>
        </div>

        <button type="submit" class="btn btn-submit">Mettre à jour</button>
        <a href="{{ route('grades.index') }}" class="btn btn-back">Retour</a>
    </form>
</body>
</html>
