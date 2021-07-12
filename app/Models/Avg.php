<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avg extends Model
{
    use HasFactory;

    protected $fillable= ['month', 'money'];

    public function setMonthAttribute($value): void
    {
        $this->attributes['month'] = $value. '-01';
    }

    public function getMonthAttribute($value)
    {
       return substr($value, 0, 7);
    }
}
