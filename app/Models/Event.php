<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['title','start_date','end_date','repeat','repeat_type','repeat_day','repeat_day_type','repeat_type_days','repeat_type_monthly'];

    public function occurance() {
        return $this->hasMany(EventDay::class);
    }
}
