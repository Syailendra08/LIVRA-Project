<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plant extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'category_id', 'plant_name', 'latin_name',
    'location', 'habitat', 'photo', 'barcode', 'stock', 'planting_date', 'condition',
    'health_benefits', 'cultural_benefits', 'description',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function category()
    {
        return $this->belongsTo(PlantCategory::class, 'category_id');
    }


    public function tip()
{
    return $this->hasOne(PlantTip::class);
}


    
    public function progresses()
    {
        return $this->hasMany(PlantProgress::class);
    }
}

