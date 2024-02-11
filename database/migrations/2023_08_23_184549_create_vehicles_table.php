<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make_model')->nullable();
            $table->integer('year');
            $table->integer('mileage_at_purchase');
            $table->string('plate_no')->unique();
            $table->string('vin')->nullable();  // it should be ->unique(); and not nullable
            $table->date('registration_date');
            $table->integer('remind_before')->default(0);
            $table->string('color')->nullable();
            $table->string('vehicle_owner')->nullable();
            $table->string('owner_email');
            $table->string('remarks')->nullable();
            $table->integer('active_alert')->default(1)->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('services');
    }
};
