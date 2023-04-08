<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauAcces extends Model
{
    use HasFactory;
    protected $fillable = ['libelle',];
    public function evenement()
    {
        return $this->belongsToMany(Evenement::class, 'cout_events','evenement_id', 'niveau_acces_id',);
    }
    public function reservation()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_events','reservation_id', 'niveau_acces_id',);
    }
}
