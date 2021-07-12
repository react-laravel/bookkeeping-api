<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'money', 'avg', 'start_date', 'end_date', 'note', 'is_renewal'];

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function setStartDateAttribute($value): void
    {
        $this->attributes['start_date'] = $value.'-01';
    }

    public function setEndDateAttribute($value): void
    {
        $this->attributes['end_date'] = $this->getLastDayOfMonth($value);
    }


    public function getStartDateAttribute($value)
    {
        return substr($value, 0, 7);
    }

    public function getEndDateAttribute($value)
    {
        return substr($value, 0, 7);
    }

    /**
     * @param $date
     * @return false|string
     */
    public function getLastDayOfMonth($date)
    {
        $firstDay = date('Y-m-01', strtotime($date));

        return date('Y-m-d', strtotime("$firstDay +1 month -1 day"));
    }
}
