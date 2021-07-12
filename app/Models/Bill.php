<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'money', 'avg', 'startDate', 'endDate', 'note'];

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function setStartDateAttribute($value): void
    {
        $this->attributes['startDate'] = $value.'-01';
    }

    public function setEndDateAttribute($value): void
    {
        $this->attributes['endDate'] = $this->getLastDayOfMonth($value);
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
