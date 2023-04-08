<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationEvents extends Model
{
    use HasFactory;
    protected $fillable = ['nbPlaces', 'reservation_id', 'niveau_acces_id',];

}
