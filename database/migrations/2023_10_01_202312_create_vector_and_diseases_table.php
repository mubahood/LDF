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
        Schema::create('vector_and_diseases', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('farm_id')->nullable()->constrained();
            $table->foreignId('animal_id')->nullable()->constrained();
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vector_and_diseases');
    }
};
