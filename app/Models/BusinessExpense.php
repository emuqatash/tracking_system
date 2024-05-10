<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessExpense extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subject',
        'description',
        'business_expenses_categories_id',
        'sub_category',
        'company_name',
        'expense_date',
        'amount',
        'notes',
        'country',
        'file',
        'file_original_filename',
        'account_id',
    ];

    protected $casts = [
        'file' => 'array',
        'file_original_filename' => 'array',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new AccountScope());
        static::creating(function ($model) {
            if (session()->has('account_id')) {
                $model->account_id = session()->get('account_id');
            }
        });
    }

    public function businessExpenseCategory(): BelongsTo
    {
        return $this->belongsTo(BusinessExpenseCategory::class, 'business_expense_categories_id', 'id');
    }
}