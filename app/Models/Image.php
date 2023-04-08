<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['titre',];

    public function evenement()
    {
        return $this->belongsToMany(Evenement::class, 'image_events', 'evenement_id', 'image_id');
    }

}
