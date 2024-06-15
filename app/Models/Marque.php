<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Voiture;


class Marque extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'pays'
    ];

    public function voitures(): BelongsToMany
    {
        return $this->belongsToMany(Voiture::class);
    }
}
