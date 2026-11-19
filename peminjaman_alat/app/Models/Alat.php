<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alats';

    protected $fillable = [
        'nama_alat',
        'kategori_id',
        'stok',
        'kondisi',
        'lokasi',
    ];

    // Relasi Alat ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi Alat ke Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'alat_id');
    }
}
