<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['category_name', 'description'];

     public function plants()
    {
        return $this->hasMany(Plant::class, 'category_id');
    }
}
