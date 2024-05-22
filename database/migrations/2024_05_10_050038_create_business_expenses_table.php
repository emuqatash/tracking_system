<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('description')->nullable();
            $table->integer('business_expense_categories_id');
            $table->integer('business_companies_id');
            $table->string('sub_category')->nullable();
            $table->date('expense_date');
            $table->decimal('amount', 8, 2);
            $table->string('country')->default('United States')->nullable();
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
