<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
    use HasFactory;
    use HasTranslations;

    public $incrementing = false;

    public $translatable = ['name'];

    // tell Eloquent that key is a string, not an integer
    protected $keyType = 'string';

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
