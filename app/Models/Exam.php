<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    use HasFactory, HasUuid, HasCreatedUpdatedBy;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'school_id',
        'exam_type_id',
        'subject_id',
        'classroom_id',
        'exam_status_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'duration',
        'instructions',
    ];

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function exam_type(): BelongsTo
    {
        return $this->belongsTo(ExamType::class);
    }

    public function exam_status(): BelongsTo
    {
        return $this->belongsTo(ExamStatus::class);
    }
}
