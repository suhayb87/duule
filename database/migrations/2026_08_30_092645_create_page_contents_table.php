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
        Schema::create('page_contents', function (Blueprint $table) {
    $table->id();
    $table->string('page');          // home, about, contact...
    $table->string('section');       // hero, story, team...
    $table->string('title')->nullable();
    $table->longText('content')->nullable();
    $table->string('image')->nullable();
    $table->json('meta')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
