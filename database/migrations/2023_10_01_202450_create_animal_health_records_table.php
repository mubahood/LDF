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
        Schema::create('animal_health_records', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('record_type');
            $table->foreignId('animal_id')->constrained();
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->unsignedInteger('recorded_by')->nullable();
            $table->foreign('recorded_by')->references('id')->on('admin_users');            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('animal_health_records');
        Schema::enableForeignKeyConstraints();
    }
};
