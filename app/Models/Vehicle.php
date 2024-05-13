<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'make_model', 'year', 'mileage_at_purchase', 'plate_no', 'vin', 'registration_date', 'remind_before', 'color',
        'vehicle_owner', 'owner_email', 'remarks', 'file', 'image', 'active_alert', 'file', 'file_original_filename'
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

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
