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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string('model')->nullable();
            $table->longText('content')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreignId('news_id')
                ->nullable()
                ->constrained('news')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreignId('sujet_id')
                ->nullable()
                ->constrained('sujets')
                ->onUpdate('cascade')
                ->onDelete('set null');


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
