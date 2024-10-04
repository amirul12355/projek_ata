<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtabTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atab', function (Blueprint $table) {
            $table->id('bil');
            $table->string('no_lot');
            $table->string('no_hakmilik');
            $table->string('jpph')->nullable();
            $table->string('sap')->nullable();
            $table->string('geran')->nullable();
            $table->json('lain_lain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atab');
    }
};
