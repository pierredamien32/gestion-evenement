<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'evenement_id','dateRes'];

    public function niveaux()
    {
        return $this->belongsToMany(NiveauAcces::class, 'reservation_events','reservation_id', 'niveau_acces_id',)
                    ->withPivot('nbPlaces');
    }

    public function evenement()
    {
        return $this->belongsTo(Evenement::class, 'evenement_id');
    }
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
