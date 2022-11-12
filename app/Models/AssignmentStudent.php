<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentStudent extends Model
{
    use HasFactory, HasCreatedUpdatedBy;

    protected $fillable = [
        'classroom_id',
        'user_id',
        'start_date',
        'end_date',
        'comment',
        'status',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
