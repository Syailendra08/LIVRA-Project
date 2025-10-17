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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('categpory_id')->constrained('plant_categories');
            $table->string('plant_name');
            $table->string('latin_name')->nullable();
            $table->string('location')->nullable();
            $table->string('habitat')->nullable();
            $table->string('photo')->nullable();
            $table->string('barcode')->unique();
            $table->integer('stock')->default(0);
            $table->date('planting_date')->nullable();
            $table->enum('condition', ['healthy', 'sick', 'dead'])->default('healthy');
            $table->text('health_benefits')->nullable();
            $table->text('cultural_benefits')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
