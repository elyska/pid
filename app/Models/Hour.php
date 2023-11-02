<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    use HasFactory;
    protected $fillable = [
        "from",
        "to",
        "opening_hour_id"
    ];
    public function openingHour()
    {
        return $this->belongsTo(OpeningHour::class);
    }
}
