<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    //kolom database yg bisa diisi secara massal
    protected $fillable = [
        'nisbn',
        'title',
        'description',
        'image_url',
        'rating',
        'stock',
        'publisher_id',
        'author_id'
    ];

    //kolom database yg sharusnya tidak ditampilkan pada JSON
    protected $hidden = [
        'author_id',
        'publisher_id'
    ];

    //kolom database yg perlu dikonversi menjadi tipe data tertentu
    protected $casts = [
        'rating' => 'double',
        'stock' => 'integer'
    ];

}
