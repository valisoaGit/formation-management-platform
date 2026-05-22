<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    protected $fillable = [
        'inscription_id',
        'numero_facture',
        'date_facture',
        'montant_total',
        'montant_paye',
        'statut',
    ];

    protected $casts = [
        'date_facture' => 'date',
        'montant_total' => 'decimal:2',
        'montant_paye' => 'decimal:2',
    ];

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }
}
