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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('livestock_type')->nullable();
            $table->string('production_type')->nullable()->comment('Milk, eggs, meat, etc');
            $table->date('date_of_establishment')->nullable();
            $table->string('size')->nullable();
            $table->string('profile_picture')->nullable();
            $table->integer('number_of_livestock')->nullable();
            $table->integer('number_of_workers')->nullable();
            $table->string('land_ownership')->nullable();
            $table->text('general_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farms');
    }
};
