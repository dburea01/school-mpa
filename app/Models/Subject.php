<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasTranslations, HasCreatedUpdatedBy;

    protected $fillable = [
        'short_name',
        'name',
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

    public function user_subjects(): HasMany
    {
        $this->hasMany(UserSubject::class);
    }
}
