<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory, HasCreatedUpdatedBy;

    protected $fillable = [
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

    public static function getCurrentPeriod(): ?Period
    {
        return Period::where('current', true)->first();
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
