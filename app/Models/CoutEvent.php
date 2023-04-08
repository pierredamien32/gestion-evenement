<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoutEvent extends Model
{
    use HasFactory;
    protected $fillable = ['cout', 'evenement_id', 'niveau_acces_id',];
}
