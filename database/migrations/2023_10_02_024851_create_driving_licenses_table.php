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
        Schema::create('driving_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('dl_number');
            $table->string('country')->default('United States');
            $table->date('expiry_date')->nullable();
            $table->integer('remind_before')->default(30);
            $table->string('remarks')->nullable();
            $table->string('attachments')->nullable();
            $table->string('attachment_file_names')->nullable();
            $table->integer('active_alert')->default(1);
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
        Schema::dropIfExists('driving_licenses');
    }
};
