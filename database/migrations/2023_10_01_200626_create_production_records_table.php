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
        Schema::create('production_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('breed_id')->constrained();
            $table->foreignId('farm_id')->constrained();
            $table->string('production_type')->nullable()->comment('Milk, eggs, meat, etc');
            $table->string('weight')->nullable();
            $table->string('daily_weight_gain')->nullable();
            $table->string('quantity')->nullable();
            $table->string('quality')->nullable();
            $table->integer('input_ratios')->nullable()->comment('Input ratios');
            $table->string('value_addition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_records');
    }
};
