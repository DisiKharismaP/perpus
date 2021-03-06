<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publisher';

    //kolom database yg bisa diisi secara massal
    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];
    
}
