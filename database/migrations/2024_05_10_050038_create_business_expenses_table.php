<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->unique();
            $table->string('description')->nullable();
            $table->integer('business_expenses_categories_id');
            $table->string('sub_category')->nullable();
            $table->string('company_name');
            $table->date('expense_date')->nullable();
            $table->decimal('amount', 8, 2);
            $table->string('notes')->nullable();
            $table->string('country')->default('United States');
            $table->string('file')->nullable();
            $table->string('file_original_filename')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_expenses');
    }
};
