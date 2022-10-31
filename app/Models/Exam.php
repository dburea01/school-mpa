<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    const FORMAT_DATE_DISPLAY = 'd/m/Y H:i';

    use HasFactory, HasCreatedUpdatedBy;

    protected $fillable = [
        'id',
        'exam_type_id',
        'subject_id',
        'classroom_id',
        'exam_status_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'duration',
        'instruction',
    ];

    public function getStartDateAttribute($value)
    {
        return $this->attributes['start_date'] = Carbon::parse($value)
        ->format(self::FORMAT_DATE_DISPLAY);
    }

    public function getEndDateAttribute($value)
    {
        return $this->attributes['end_date'] = Carbon::parse($value)
        ->format(self::FORMAT_DATE_DISPLAY);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat(self::FORMAT_DATE_DISPLAY, $value)
        ->format('Y-m-d H:i');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat(self::FORMAT_DATE_DISPLAY, $value)
        ->format('Y-m-d H:i');
    }

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

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
