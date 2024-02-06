<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrivingLicense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'full_name', 'dl_number', 'expiry_date', 'remind_before', 'remarks',
        'attachments', 'attachment_file_names', 'country'
    ];

    protected $casts = [
        'attachments' => 'array',
        'attachment_file_names' => 'array'
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
}
