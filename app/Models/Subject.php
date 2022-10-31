<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasTranslations, HasCreatedUpdatedBy;

    protected $fillable = [
        'short_name',
        'name',
        'position',
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
}
