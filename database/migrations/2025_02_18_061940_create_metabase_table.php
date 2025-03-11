<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('metabase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sektor');
            $table->string('kategori');
            $table->text('link_metabase');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_sektor')
                  ->references('id_sektor')
                  ->on('sektor')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metabase');
    }
};
