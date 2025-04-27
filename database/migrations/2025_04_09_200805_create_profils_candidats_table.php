<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profils_candidats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('telephone')->nullable();
            $table->text('profil')->nullable();
            $table->string('cv')->nullable();
            $table->string('adresse')->nullable();
            $table->string('photo_profil')->nullable();
            $table->string('status')->default('en attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profils_candidats');
    }
};