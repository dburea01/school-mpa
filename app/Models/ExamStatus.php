<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ExamStatus extends Model
{
    use HasTranslations, HasFactory;

    public $translatable = ['short_name', 'comment'];

    protected $table = 'exam_status';

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'id',
        'position',
        'short_name',
        'comment',
    ];
}
