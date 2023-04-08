<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['titre',];

    public function evenement()
    {
        return $this->belongsToMany(Evenement::class, 'video_events','evenement_id', 'video_id');
    }
}
