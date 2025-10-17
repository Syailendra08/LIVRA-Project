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

    // 🔹 Relasi ke Category (satu Plant punya satu kategori)
    public function category()
    {
        return $this->belongsTo(PlantCategory::class, 'category_id');
    }

    // 🔹 Relasi ke PlantTips (satu Plant bisa punya banyak tips)
    public function tip()
{
    return $this->hasOne(PlantTip::class);
}


    // 🔹 Relasi ke PlantProgress (satu Plant bisa punya banyak progress)
    public function progresses()
    {
        return $this->hasMany(PlantProgress::class);
    }
}

