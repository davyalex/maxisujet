<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'profil',
        'email',
        'password',
        'email_verified_at',
        'is_email_verified',
        'last_login_at',
        'last_login_ip',
        'point'

    ];



    /**
     * Get all of the news for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function sujets(): HasMany
    {
        return $this->hasMany(Sujet::class);
    }

    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class);
    }

    
    public function sujet_download(): BelongsToMany
    {
        return $this->belongsToMany(Sujet::class, 'telechargements', 'user_id', 'sujet_id')->withTimestamps();
    }

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
}
