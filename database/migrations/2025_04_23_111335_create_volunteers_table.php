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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();

            // basic info
            $table->json('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('national_id')->nullable(); // for Identity verification
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            //  skills and profession
            $table->json('profession')->nullable();
            $table->json('skills')->nullable(); // list of skills

            // availability and commitment
            $table->enum('availability', ['full_time', 'part_time', 'weekends'])->nullable();
            $table->date('join_date')->default(now());
            $table->boolean('is_active')->default(true);

            //  files and management
            $table->string('profile_photo')->nullable();
            $table->json('CV')->nullable();
            $table->json('notes')->nullable();
            $table->softDeletes()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
