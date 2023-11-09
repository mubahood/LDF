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
            $table->string('coordinates')->nullable();
            $table->foreignId('location_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->string('livestock_type')->nullable();
            $table->string('production_type')->nullable()->comment('Milk, eggs, meat, etc');
            $table->string('date_of_establishment')->nullable();
            $table->string('size')->nullable();
            $table->string('profile_picture')->nullable();
            $table->integer('number_of_livestock')->nullable();
            $table->integer('number_of_workers')->nullable();
            $table->string('land_ownership')->nullable();
            $table->string('no_land_ownership_reason')->nullable();
            $table->text('general_remarks')->nullable();
            $table->unsignedInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('admin_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('farms');
        Schema::enableForeignKeyConstraints();
    }
};
