<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Enregistrer un paiement</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; color: white; border: none; cursor: pointer; text-decoration: none; border-radius: 3px; }
        .btn-submit { background-color: green; }
        .btn-back { background-color: gray; }
    </style>
</head>
<body>
    <h1>Enregistrer un nouveau versement</h1>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Sélectionner l'Élève</label>
            <select name="student_id" id="student_id" required>
                <option value="">-- Choisir un élève --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->first_name }} {{ $student->last_name }} ({{ $student->classroom->name ?? 'Sans classe' }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount_paid">Montant du versement (FCFA)</label>
            <input type="number" name="amount_paid" id="amount_paid" min="0" required>
        </div>
        <button type="submit" class="btn btn-submit">Valider le versement</button>
        <a href="{{ route('payments.index') }}" class="btn btn-back">Retour</a>
    </form>
</body>
</html>
