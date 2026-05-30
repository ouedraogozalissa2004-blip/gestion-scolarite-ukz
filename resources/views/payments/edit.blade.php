<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un versement</title>
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
    <h1>Modifier le versement</h1>

    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="student_id">Élève associé</label>
            <select name="student_id" id="student_id" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $payment->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount_paid">Montant (FCFA)</label>
            <input type="number" name="amount_paid" id="amount_paid" value="{{ $payment->amount_paid }}" min="0" required>
        </div>
        <button type="submit" class="btn btn-submit">Mettre à jour</button>
        <a href="{{ route('payments.index') }}" class="btn btn-back">Retour</a>
    </form>
</body>
</html>
