<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class tempTable extends Model
{
    use Notifiable;
    use HasFactory;
    protected $fillable = ['nom',
    'prenom',
    'sigle',
    'ifu',
    'adresse',
    'pays',
    'email',
    'sociale',
    'password',
    'tel',
    'fixe',
    'description',
    'role',
    'code',
];
}
