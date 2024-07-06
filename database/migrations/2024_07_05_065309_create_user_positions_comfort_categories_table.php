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
        Schema::create('user_positions_comfort_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_position_id')->constrained('user_positions')->onDelete('cascade');
            $table->foreignId('comfort_category_id')->constrained('comfort_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_positons_comfort_categories');
    }
};
