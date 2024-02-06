<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('miscellaneouses', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->unique();
            $table->string('description')->nullable();
            $table->integer('miscellaneous_categories_id');
            $table->string('sub_category')->nullable();
            $table->date('followup_date')->nullable();
            $table->integer('followup_before_day')->nullable();
            $table->string('purchased_from')->nullable();
            $table->decimal('cost')->nullable();
            $table->string('file')->nullable();
            $table->string('file_original_filename')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('miscellaneouses');
    }
};
