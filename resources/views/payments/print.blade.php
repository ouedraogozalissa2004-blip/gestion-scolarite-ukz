<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Paiement - École La Grâce</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; padding: 20px; }
        .receipt-box { max-width: 600px; margin: auto; border: 2px solid #333; padding: 30px; border-radius: 8px; }
        .header { text-align: center; border-bottom: 2px dashed #ccc; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; color: #04AA6D; }
        .details { margin-bottom: 30px; line-height: 1.8; }
        .amount-box { background-color: #f4f4f4; border: 1px solid #ccc; padding: 15px; text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 20px; }
        .footer { text-align: right; margin-top: 40px; font-style: italic; }
        .no-print { text-align: center; margin-bottom: 20px; }
        .btn-print { background-color: #0056b3; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; text-decoration: none; }
        
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
            .receipt-box { border: none; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print();" class="btn-print">🖨️ Lancer l'impression</button>
        <a href="{{ route('payments.index') }}" style="margin-left: 20px; color: #333;">Retour à l'historique</a>
    </div>

    <div class="receipt-box">
        <div class="header">
            <h1>ÉCOLE LA GRÂCE</h1>
            <p>B.P. 1234 - Tél: +226 XX XX XX XX</p>
            <h2>REÇU DE PAIEMENT N° {{ $payment->id }}</h2>
            <p>Date : {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') : $payment->created_at->format('d/m/Y') }}</p>
        </div>

        <div class="details">
            <p><strong>Nom & Prénom de l'Élève :</strong> {{ $payment->student->first_name }} {{ $payment->student->last_name }}</p>
            <p><strong>Classe :</strong> {{ $payment->student->classroom->name ?? 'Non définie' }}</p>
            <p><strong>Motif :</strong> Frais de scolarité</p>
        </div>

        <div class="amount-box">
            Montant Versé : {{ number_format($payment->amount_paid, 0, ',', ' ') }} FCFA
        </div>

        <div class="footer">
            <p>Le Comptable,</p>
            <p style="margin-top: 50px;">Signature et Cachet</p>
        </div>
    </div>

</body>
</html>
