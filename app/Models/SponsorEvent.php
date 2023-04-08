<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorEvent extends Model
{
    use HasFactory;
    protected $fillable = ['evenement_id', 'sponsor_id'];

}
