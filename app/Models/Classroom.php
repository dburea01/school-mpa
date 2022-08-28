<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory, HasUuid, HasCreatedUpdatedBy;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'school_id',
        'period_id',
        'name',
        'comment',
        'status'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
