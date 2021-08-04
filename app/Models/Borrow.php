<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    //kolom database yg bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'book_id',
        'periode',
        'deadline',
        'return',
    ];

    //kolom database yg sharusnya tidak ditampilkan pada JSON
    protected $hidden = [
        'user_id',
        'book_id',
    ];

    //kolom database yg perlu dikonversi menjadi tipe data tertentu
    protected $casts = [
        'return' => 'dateTime',
        'deadline' => 'dateTime',
        'periode' => 'dateTime',
    ];
}
