<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory, HasUuid, HasCreatedUpdatedBy;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'school_id',
        'exam_id',
        'user_id',
        'note_num',
        'note_alpha',
        'comment',
    ];

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
