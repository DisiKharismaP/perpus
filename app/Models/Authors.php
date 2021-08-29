<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    //kolom database yg bisa diisi secara massal
    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];
    
}
