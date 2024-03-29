<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class InitSubject extends Model
{
    use HasFactory;
    use HasCreatedUpdatedBy;
    use HasTranslations;

    public $incrementing = false;
    protected $primaryKey = 'short_name';

    public $translatable = ['name'];

    // tell Eloquent that key is a string, not an integer
    protected $keyType = 'string';

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'short_name',
        'name',
        'position',
        'comment',
        'status'
    ];
}
