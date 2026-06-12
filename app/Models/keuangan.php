<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    // Pastikan ini 'keuangans' sesuai nama tabel di database Anda
    protected $table = 'keuangans'; 
    protected $fillable = ['tanggal', 'keterangan', 'jenis', 'nominal'];
}