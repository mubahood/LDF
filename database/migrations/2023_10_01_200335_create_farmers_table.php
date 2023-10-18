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
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->string('surname');
            $table->string('given_name');
            $table->date('date_of_birth')->nullable();
            $table->string('nin')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('number_of_dependants')->nullable()->comment('Number of dependants / other farmers');
            $table->string('farmer_group')->nullable();
            $table->string('primary_phone_number')->nullable();
            $table->string('secondary_phone_number')->nullable();
            $table->boolean('is_land_owner')->default(false);
            $table->string('production_scale')->nullable();
            $table->boolean('access_to_credit')->default(false);
            $table->date('date_started_farming')->nullable();
            $table->string('highest_level_of_education')->nullable();
            $table->unsignedInteger('applicatant_id')->nullable();
            $table->foreign('applicatant_id')->references('id')->on('admin_users');
            $table->boolean('is_verified')->default(false);
            $table->text('agent_remarks')->nullable();
            $table->unsignedInteger('agent_id')->nullable();
            $table->foreign('agent_id')->references('id')->on('admin_users');
            $table->text('admin_remarks')->nullable();
            $table->unsignedInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admin_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('farmers');

        Schema::enableForeignKeyConstraints();
    }
};
