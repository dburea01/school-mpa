<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Period extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'school_id',
        'name',
        'start_date',
        'end_date',
        'current',
        'comment'
    ];

    protected function getStartDateAttribute($value)
    {
        return isset($value) ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : '';
    }

    protected function getEndDateAttribute($value)
    {
        return isset($value) ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : '';
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
