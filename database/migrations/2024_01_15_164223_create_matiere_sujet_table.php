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
        Schema::create('matiere_sujet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sujet_id')
            ->nullable()
            ->constrained('sujets')
            ->onUpdate('cascade')
            ->onDelete('set null');

            $table->foreignId('matiere_id')
            ->nullable()
            ->constrained('matieres')
            ->onUpdate('cascade')
            ->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matiere_sujet');
    }
};
