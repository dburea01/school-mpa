<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory, HasUuid, HasCreatedUpdatedBy;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'school_id',
        'name',
        'start_date',
        'end_date',
        'current',
        'comment',
    ];

    protected function getStartDateAttribute($value)
    {
        return isset($value) ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : '';
    }

    protected function getEndDateAttribute($value)
    {
        return $this->getStartDateAttribute($value);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
