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
        Schema::create('tanahs', function (Blueprint $table) {
            $table->id();
            $table->string('no_tanah');      // Land Number
    $table->string('nama_tanah');    // Land Name
    $table->decimal('harga_tanah', 10, 2); // Land Price
    $table->decimal('luas_tanah', 8, 2);   // Land Area
    $table->string('status_tanah');  // Land Status
    $table->string('pemilik_tanah'); // Land Owner
    $table->string('file_path')->nullable(); // Path for uploaded files
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanahs');
    }
};
