<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{
    use HasFactory;
    protected $fillable = ["from", "to", "location_id"];

    public function location()
    {
        return $this->belongsTo(Location::class, "location_id");
    }
    public function hours()
{
    return $this->hasMany(Hour::class);
}
}
