<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'school_id',
        'short_name',
        'name',
        'option',
        'status',
        'comment'
    ];

    public function setShortNameAttribute($value): void
    {
        $this->attributes['short_name'] = strtoupper($value);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
