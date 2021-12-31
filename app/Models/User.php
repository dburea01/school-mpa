<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuid;

    public $incrementing = false;

    protected $keyType = 'string';
    
    protected $fillable = [
        'role_id',
        'last_name',
        'first_name',
        'birth_date',
        'comment',
        'email',
        'password',
        'status',
        'genre_id'
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

    public function isSuperAdmin()
    {
        return $this->role_id === 'SUPERADMIN';
    }
    
    public function isDirector()
    {
        return $this->role_id === 'DIRECTOR';
    }
    
    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : null;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtoupper($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords($value);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
