<?php

namespace App\Models;

use Iluminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Siswa extends Model
{
    protected $fillable = [
        'id_user',
        'image',
        'nis',
        'tingkatan',
        'jurusan',
        'kelas',
        'hp',
        'status',
    ];
}
