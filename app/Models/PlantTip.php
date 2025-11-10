<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantTip extends Model
{
    use SoftDeletes;

   protected $fillable = ['plant_id', 'watering', 'lighting', 'growing_media'];

   
    public function plant()
    {
        return $this->belongsTo(Plant::class, 'plant_id');
    }
}
