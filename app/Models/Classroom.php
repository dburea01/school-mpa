<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory, HasCreatedUpdatedBy;

    protected $fillable = [
        'period_id',
        'name',
        'comment',
        'status',
    ];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function assignmentStudents()
    {
        return $this->hasMany(AssignmentStudent::class);
    }
}
