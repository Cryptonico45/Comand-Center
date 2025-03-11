<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('nib', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key (auto increment)
            $table->string('nib')->unique(); // Kolom NIB (harus unik)
            $table->date('tanggal_terbit_oss'); // Kolom tanggal terbit
            $table->string('nama_perusahaan'); // Nama perusahaan
            $table->string('status_pm'); // Status PM (misalnya PMDN)
            $table->string('jenis_perusahaan'); // Jenis perusahaan (misalnya Perorangan)
            $table->string('alamat'); // Alamat perusahaan
            $table->string('kelurahan'); // Kelurahan
            $table->string('kecamatan'); // Kecamatan
            $table->string('kab_kota'); // Kabupaten/Kota
            $table->string('email')->nullable(); // Email (harus unik)
            $table->string('nomor_telp')->nullable(); // Nomor telepon (boleh kosong)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('nib'); // Menghapus tabel jika rollback
    }
};
