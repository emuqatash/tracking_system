<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Miscellaneous extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'subject', 'description', 'miscellaneous_categories_id', 'sub_category', 'followup_date', 'followup_before_day',
        'purchased_from', 'cost', 'file', 'file_original_filename'
    ];

    protected $casts = [
        'file' => 'array',
        'file_original_filename' => 'array',
//        'cost' => MoneyCast::class, //use this to round the cost from 4500.75 to 4501
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

    public function miscellaneousCategory(): BelongsTo
    {
        return $this->belongsTo(MiscellaneousCategory::class, 'miscellaneous_categories_id', 'id');
    }
}
