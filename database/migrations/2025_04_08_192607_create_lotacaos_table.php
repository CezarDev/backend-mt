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
        Schema::create('lotacaos', function (Blueprint $table) {
            $table->id('lot_id');
            $table->foreignId('pes_id')->constrained('pessoas', 'pes_id')->onDelete('cascade');
            $table->foreignId('unid_id')->constrained('unidades', 'unid_id')->onDelete('cascade');
            $table->date('lot_data_lotacao');
            $table->date('lot_data_remocao')->nullable();
            $table->string('lot_portaria', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotacaos');
    }
};
