<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // Clé étrangère reliée à l'élève qui effectue le versement
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->decimal('amount_paid', 10, 2); // Montant versé ce jour-là
            $table->date('payment_date'); // Date du reçu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
