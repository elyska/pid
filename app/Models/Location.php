<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        "strid",
        "type",
        "name",
        "address",
        "lat",
        "lon",
        "services",
        "payMethods",
    ];
    public function openingHours()
    {
        return $this->hasMany(OpeningHour::class, "location_id", "id");
    }
}
