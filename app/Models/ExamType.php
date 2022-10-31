<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ExamType extends Model
{
    use HasTranslations, HasFactory, HasCreatedUpdatedBy;

    public $translatable = ['short_name', 'name'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'position',
        'short_name',
        'name',
        'status',
    ];
}
