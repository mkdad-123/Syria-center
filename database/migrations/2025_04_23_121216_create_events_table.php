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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->enum('type', ['festival', 'volunteering', 'workshop']);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->json('location');
            $table->integer('max_participants')->nullable();
            $table->boolean('is_published')->default(false);
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
