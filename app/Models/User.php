<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuid, HasCreatedUpdatedBy;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'role_id',
        'group_id',
        'last_name',
        'first_name',
        'birth_date',
        'comment',
        'email',
        'password',
        'status',
        'gender_id',
        'civility_id',
        'address1',
        'address2',
        'address3',
        'zip_code',
        'city',
        'country_id',
        'phone_number',
        'user_image_url'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(50)
              ->height(50);
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

    public function isSuperAdmin()
    {
        return $this->role_id === 'SUPERADMIN';
    }

    public function isDirector()
    {
        return $this->role_id === 'DIRECTOR';
    }

    public function isTeacher()
    {
        return $this->role_id === 'TEACHER';
    }

    public function isActive(): bool
    {
        return $this->status === 'ACTIVE';
    }

    public function getFullNameAttribute()
    {
        return $this->role_id !== 'STUDENT' ?
        "{$this->civility->short_name} {$this->last_name} {$this->first_name}" :
        "{$this->last_name} {$this->first_name}";
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

    public function age()
    {
        return Carbon::parse($this->attributes['birth_date'])->diff(Carbon::now())->format('%y Y %m M');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function civility()
    {
        return $this->belongsTo(Civility::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function user_groups()
    {
        return $this->hasMany(UserGroup::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
