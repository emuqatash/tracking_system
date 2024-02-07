<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Scopes\AccountScope;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new AccountScope());
        static::creating(function ($model) {
            if (session('account_id')) {
                $model->account_id = session()->get('account_id');
            }
        });

        static::created(function ($model) {
            if (!session('account_id')) {
                $model->account_id = $model->id;
            }
            $model->assignRole('Writer');
            $model->save();
        });
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['Admin', 'Supervisor', 'Writer']);
//        return str_ends_with($this->email, '@example.com') && $this->hasVerifiedEmail();

    }

//The getFilamentName() method is used to retrieve the name of the current user.
//    public function getFilamentName(): string
//    {
//        return "{$this->first_name} {$this->last_name}";
//    }

}
