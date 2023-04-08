<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = ['intitule', 'entreprise_id', 'role_id','category_id','description','lieu','statut','dateDebut', 'dateFin', 'heure'];

    public function categorie()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }
    public function utilisateur()
    {
        return $this->belongsTo(Admin::class, 'entreprise_id');
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_events', 'evenement_id', 'image_id');
    }
    public function cout()
    {
        return $this->belongsToMany(CoutEvent::class, 'cout');
    }
    public function getFirstImageAttribute()
    {
        return $this->images->first();
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_events','evenement_id', 'video_id');
    }

    public function niveaux()
    {
        return $this->belongsToMany(NiveauAcces::class, 'cout_events','evenement_id', 'niveau_acces_id',)
                    ->withPivot('cout');
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'evenement_id');
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'sponsor_events', 'evenement_id', 'sponsor_id');
    }

}
