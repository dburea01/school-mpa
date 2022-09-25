<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ExamType extends Model
{
    use HasTranslations, HasFactory;

    public $translatable = ['short_name', 'name'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'school_id',
        'position',
        'short_name',
        'name',
        'status',
    ];
}
