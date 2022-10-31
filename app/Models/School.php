<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory, HasCreatedUpdatedBy;

    protected $fillable = [
        'name',
        'address1',
        'address2',
        'address3',
        'zip_code',
        'city',
        'country_id'
    ];

    public function setCountryIdAttribute($value)
    {
        $this->attributes['country_id'] = strtoupper($value);
    }
}
