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
        Schema::create('financial_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained();
            $table->foreignId('farmer_id')->constrained();
            $table->string('transaction_type')->nullable()->comment('Income, expenditure, etc');
            $table->date('transaction_date')->nullable();
            $table->mediumText('description')->nullable();
            $table->double('amount', 12, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('party')->nullable()->comment('Payment made to or from');
            $table->string('party_tin')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('reciept_file')->nullable()->comment('Reciept file path');
            $table->mediumText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_records');
    }
};
