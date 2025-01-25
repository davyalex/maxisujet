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
        Schema::create('sujet_news', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('annee')->nullable();
            $table->string('categorie')->nullable();
            $table->string('niveau')->nullable();
            $table->string('matiere')->nullable();
            $table->string('etablissement')->nullable();
            $table->boolean('approved')->default(0);




            // $table->text('description')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            // $table->foreignId('category_id')
            //     ->nullable()
            //     ->constrained('categories')
            //     ->onUpdate('cascade')
            //     ->onDelete('set null');

            // $table->foreignId('etablissement_id')
            //     ->nullable()
            //     ->constrained('etablissements')
            //     ->onUpdate('cascade')
            //     ->onDelete('set null');
            

            $table->string('sujet_file')->nullable();  //file of sujet
            $table->string('corrige_file')->nullable();  //file of sujet corrige
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sujet_news');
    }
};
