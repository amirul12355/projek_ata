<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtatTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atat', function (Blueprint $table) {
            $table->id();
            $table->string('no_lot');
            $table->string('no_hakmilik');
            $table->string('cpc')->nullable();
            $table->string('jkr66a')->nullable();
            $table->string('doc_auc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atat');
    }
};
