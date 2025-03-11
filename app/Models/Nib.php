<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nib extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan
    protected $table = 'nib';

    // Tentukan kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'nib',
        'tanggal_terbit_oss',
        'nama_perusahaan',
        'status_pm',
        'jenis_perusahaan',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kab_kota',
        'email',
        'nomor_telp',
    ];

    // Konversi tanggal agar otomatis dalam format Date
    protected $casts = [
        'tanggal_terbit_oss' => 'date',
    ];
}
