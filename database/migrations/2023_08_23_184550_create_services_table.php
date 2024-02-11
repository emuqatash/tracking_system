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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->cascadeOnDelete();
            $table->integer('current_mileage')->nullable();
            $table->integer('part_id')->nullable();
            $table->integer('shop_id')->nullable();
            // $table->boolean('part_warranty')->default(false);
            $table->decimal('part_warranty_period')->nullable();
            // $table->boolean('labor_warranty')->default(false);
            $table->decimal('labor_warranty_period')->nullable();
            $table->date('repair_date')->nullable();
            $table->decimal('part_cost')->nullable();
            $table->decimal('labor_cost')->nullable();
            $table->decimal('total_cost')->nullable();
            $table->string('file')->nullable();
            $table->string('file_original_filename')->nullable();
            $table->string('image')->nullable();
            $table->string('image_original_filename')->nullable();
            $table->integer('followup_mileage')->nullable();
            $table->date('followup_date')->nullable();
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
        Schema::dropIfExists('services');
    }
};
