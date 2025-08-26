<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partisipasi_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained('challenges')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('bukti')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->integer('poin')->default(0);
            $table->timestamps();

            $table->unique(['challenge_id', 'user_id']); // user tidak bisa ikut challenge yang sama 2x
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partisipasi_challenges');
    }
};
