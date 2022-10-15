<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory, HasUuid, HasCreatedUpdatedBy;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'address1',
        'address2',
        'address3',
        'zip_code',
        'city',
        'country_id',
        'max_users',
        'comment',
        'status',
        's3_container'
    ];

    public function setCountryIdAttribute($value)
    {
        $this->attributes['country_id'] = strtoupper($value);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function periods(): HasMany
    {
        return $this->hasMany(Period::class);
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
