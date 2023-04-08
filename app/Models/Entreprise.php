<?php

namespace App\Models;
use Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom','sigle','description','ifu','pays','adresse'];
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function evenement()
    {
        return $this->hasMany(Evenement::class, 'entreprise_id');
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
    protected $guarded = ['id'];
}

