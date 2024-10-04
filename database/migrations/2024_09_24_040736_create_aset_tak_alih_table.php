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
        Schema::create('aset_tak_alih', function (Blueprint $table) {
            $table->id();
            $table->string('kod_ao');
            $table->string('kod_ptj');
            $table->string('nama_ptj');
            $table->string('negeri');
            $table->string('daerah');
            $table->string('bandar');
            $table->string('no_lot');
            $table->string('no_hakmilik');
            $table->string('luas_tanah');
            $table->string('no_lot_lama')->nullable();
            $table->string('no_hakmilik_lama')->nullable();
            $table->string('luas_tanah_lama')->nullable();
            $table->decimal('nilai_tanah_jpph', 15, 2)->nullable();
            $table->decimal('nilai_bangunan_jpph', 15, 2)->nullable();
            $table->decimal('nilai_tanah_igfmas', 15, 2)->nullable();
            $table->decimal('nilai_bangunan_igfmas', 15, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_tak_alih');
    }
};
