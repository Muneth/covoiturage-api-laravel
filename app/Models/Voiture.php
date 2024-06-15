<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Marque;


class Voiture extends Model
{
    use HasFactory;
    protected $fillable = [
        'modele',
        'immatriculation',
        'places',
        'marque_id',
        'couleur'
    ];

    public function marque(): BelongsTo
    {
        return $this->belongsTo(Marque::class);
    }
}
