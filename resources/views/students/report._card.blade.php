<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bulletin de Notes - École La Grâce</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #333; padding: 20px; line-height: 1.4; }
        .bulletin-box { max-width: 800px; margin: auto; border: 2px solid #333; padding: 30px; border-radius: 8px; background: #fff; }
        .header { display: flex; justify-content: space-between; border-bottom: 3px double #333; padding-bottom: 15px; margin-bottom: 20px; }
        .school-info h1 { margin: 0; font-size: 22px; color: #04AA6D; text-transform: uppercase; }
        .school-info p { margin: 3px 0; font-size: 12px; color: #666; }
        .bulletin-title { text-align: center; margin: 20px 0; }
        .bulletin-title h2 { margin: 0; font-size: 24px; text-transform: uppercase; letter-spacing: 1px; }
        .student-info { background: #f9f9f9; border: 1px solid #ddd; padding: 15px; border-radius: 4px; margin-bottom: 25px; display: flex; justify-content: space-between; }
        .student-info p { margin: 5px 0; font-size: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; text-transform: uppercase; font-size: 13px; }
        .total-row { font-weight: bold; background-color: #eafaf1; }
        .signatures { margin-top: 50px; display: flex; justify-content: space-between; }
        .signature-block { text-align: center; width: 45%; font-weight: bold; }
        .no-print { text-align: center; margin-bottom: 20px; background: #f4f4f4; padding: 15px; border-radius: 4px; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; }
        .btn-print { background-color: #0056b3; color: white; }
        .btn-back { background-color: #666; color: white; margin-left: 10px; }
        select { padding: 8px; font-size: 14px; margin-right: 10px; }

        @media print {
            .no-print { display: none; }
            body { padding: 0; background: none; }
            .bulletin-box { border: none; padding: 0; }
        }
    </style>
</head>
<body>

    <!-- Section de filtrage et d'impression (masquée sur le papier) -->
    <div class="no-print">
        <form method="GET" action="" style="display: inline-block;">
            <label for="quarter"><strong>Changer de trimestre :</strong></label>
            <select name="quarter" id="quarter" onchange="this.form.submit()">
                <option value="1" {{ $quarter == 1 ? 'selected' : '' }}>Trimestre 1</option>
                <option value="2" {{ $quarter == 2 ? 'selected' : '' }}>Trimestre 2</option>
                <option value="3" {{ $quarter == 3 ? 'selected' : '' }}>Trimestre 3</option>
            </select>
        </form>
        <button onclick="window.print();" class="btn btn-print">🖨️ Imprimer le Bulletin</button>
        <a href="{{ route('students.index') }}" class="btn btn-back">Retour aux Élèves</a>
    </div>

    <!-- Le Bulletin physique -->
    <div class="bulletin-box">
        <div class="header">
            <div class="school-info">
                <h1>ÉCOLE LA GRÂCE</h1>
                <p>Enseignement Général de Qualité</p>
                <p>B.P. 1234 • Tél: +226 XX XX XX XX</p>
            </div>
            <div style="text-align: right;">
                <p><strong>Année Scolaire :</strong> 2025 - 2026</p>
            </div>
        </div>

        <div class="bulletin-title">
            <h2>Bulletin de Notes</h2>
            <p><strong>Période :</strong> Trimestre {{ $quarter }}</p>
        </div>

        <div class="student-info">
            <div>
                <p><strong>Nom & Prénom :</strong> {{ $student->last_name }} {{ $student->first_name }}</p>
                <p><strong>Classe :</strong> {{ $student->classroom->name ?? 'Non définie' }}</p>
            </div>
            <div style="text-align: right;">
                <p><strong>Statut Scolarité :</strong> {!! $student->tuitionStatus() !!}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Matières</th>
                    <th>Note / 20</th>
                    <th>Appréciations</th>
                </tr>
            </thead>
            <tbody>
                @forelse($student->grades as $grade)
                    <tr>
                        <td><strong>{{ $grade->subject->name ?? 'Matière' }}</strong></td>
                        <td><strong>{{ $grade->score }}</strong> / 20</td>
                        <td>
                            @if($grade->score >= 16) Très Bien
                            @elseif($grade->score >= 14) Bien
                            @elseif($grade->score >= 12) Assez Bien
                            @elseif($grade->score >= 10) Passable
                            @else Insuffisant
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: gray; padding: 20px;">
                            Aucune note enregistrée pour ce trimestre.
                        </td>
                    </tr>
                @endforelse

                <!-- Ligne de la Moyenne Générale du Trimestre choisi -->
                <tr class="total-row">
                    <td>MOYENNE TRIMESTRIELLE</td>
                    <td colspan="2" style="font-size: 16px;">
                        {{ $student->grades->count() > 0 ? round($student->grades->avg('score'), 2) : 'N/A' }} / 20
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="signatures">
            <div class="signature-block">
                <p>Le Titulaire de la Classe</p>
                <div style="margin-top: 60px; border-bottom: 1px dashed #ccc; width: 80%; margin-left: auto; margin-right: auto;"></div>
            </div>
            <div class="signature-block">
                <p>Le Directeur de l'École</p>
                <div style="margin-top: 60px; border-bottom: 1px dashed #ccc; width: 80%; margin-left: auto; margin-right: auto;"></div>
            </div>
        </div>
    </div>

</body>
</html>
