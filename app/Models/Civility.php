<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Civility extends Model
{
    use HasTranslations;

    public $incrementing = false;

    // tell Eloquent that key is a string, not an integer
    protected $keyType = 'string';

    public $translatable = ['short_name', 'name'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'id',
        'short_name',
        'name',
        'is_active',
        'position',
    ];
}
