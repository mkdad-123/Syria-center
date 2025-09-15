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
        Schema::create('service_volunteers', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('volunteer_id')->constrained('volunteers');
            $table->date('assigned_at')->default(now());
            $table->primary(['service_id', 'volunteer_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_volunteers');
    }
};
