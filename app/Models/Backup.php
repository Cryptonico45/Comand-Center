<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $table = 'permohonan_izin_penetapan'; // Nama tabel di database

    // Tambahke sequence generator nggo PostgreSQL
    protected $sequence = 'permohonan_izin_penetapan_id_seq';

    public $incrementing = true;

    public $timestamps = false; // Matikan timestamps jika tidak ada created_at & updated_at

    protected $fillable = [
        'id',
        'no_permohonan',
        'jenis_izin',
        'izin_ke',
        'jenis_permohonan',
        'tgl_pengajuan',
        'lokasi_izin',
        'status_penetapan',
        'tgl_penetapan',
        'no_izin',
        'tgl_selesai',
        'masa_berlaku',
        'tipe_pemohon',
        'tipe_identitas',
        'no_identitas',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'no_telp',
        'no_hp',
        'email',
        'alamat',
        'nama_perusahaan',
        'no_tlp',
        'file_signed_report',
        'tgl_signed_report',
        'del',
        'jenis_izin_id',
        'pemohon_id',
        'npwp'
    ];
}
