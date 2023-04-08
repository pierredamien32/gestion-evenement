<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'telephone',];
    public function evenement()
    {
        return $this->hasMany(Evenement::class, 'entreprise_id');
    }
}
