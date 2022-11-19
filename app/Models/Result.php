<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory, HasCreatedUpdatedBy;

    protected $fillable = [
        'exam_id',
        'user_id',
        'appreciation_id',
        'note_num',
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

    public function appreciation(): BelongsTo
    {
        return $this->belongsTo(Appreciation::class);
    }
}
