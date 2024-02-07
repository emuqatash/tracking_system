<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Part extends Model
{
    use HasFactory;

    protected $table = 'parts';
    protected $fillable = ['name'];

    protected static function booted(): void
    {
        static::addGlobalScope(new AccountScope());
        static::creating(function ($model) {
            if (session()->has('account_id')) {
                $model->account_id = session()->get('account_id');
            }
        });
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
