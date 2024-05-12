<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessCompany extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
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

    public function businessExpense(): HasMany
    {
        return $this->hasMany(BusinessExpense::class);
    }
}
