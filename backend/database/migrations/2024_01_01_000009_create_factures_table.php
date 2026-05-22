<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')->constrained('inscriptions');
            $table->string('numero_facture')->unique();
            $table->date('date_facture');
            $table->decimal('montant_total', 12, 2);
            $table->decimal('montant_paye', 12, 2)->default(0);
            $table->enum('statut', ['brouillon', 'emise', 'payee', 'partiellement_payee', 'annulee'])->default('emise');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
