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
        Schema::create('plant_progress', function (Blueprint $table) {
            $table->id('progress_id');
             $table->foreignId('user_id')->constrained('users');
             $table->foreignId('plant_id')->constrained('plants')->onDelete('cascade');
             $table->enum('progress_type', ['planting', 'maintenance', 'harvesting']);
             $table->text('description')->nullable();
             $table->date('progress_date')->nullable();
             $table->timestamps();
             $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_progress');
    }
};
