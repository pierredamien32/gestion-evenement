<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $fillable = ['nom',];

    public function evenement()
    {
        return $this->belongsToMany(Evenement::class,  'sponsor_events', 'evenement_id', 'sponsor_id');
    }

}
