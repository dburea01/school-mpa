<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, HasUuid;

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
        'group_id',
        'comment',
        'status',
    ];

    public function setCountryIdAttribute($value)
    {
        $this->attributes['country_id'] = strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function user_groups()
    {
        return $this->hasMany(UserGroup::class);
    }
}
