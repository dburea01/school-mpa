<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasUuid, HasTranslations, HasCreatedUpdatedBy;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'school_id',
        'short_name',
        'name',
        'option',
        'status',
        'comment',
    ];

    public $translatable = [
        'name',
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
