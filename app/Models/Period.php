<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory, HasCreatedUpdatedBy;

    const DMY = 'd/m/Y';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'current',
        'comment',
    ];

    protected function getStartDateAttribute($value)
    {
        return isset($value) ? Carbon::createFromFormat('Y-m-d', $value)->format(self::DMY) : '';
    }

    protected function getEndDateAttribute($value)
    {
        return $this->getStartDateAttribute($value);
    }

    protected function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat(self::DMY, $value)->format('Y-m-d');
    }

    protected function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat(self::DMY, $value)->format('Y-m-d');
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
