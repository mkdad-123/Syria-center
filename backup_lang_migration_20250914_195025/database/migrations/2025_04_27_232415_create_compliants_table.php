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
        Schema::create('compliants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_user_id')->constrained('customusers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('content');
            $table->string('email');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compliants');
    }
};
