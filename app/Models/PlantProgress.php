<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantProgress extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'plant_id', 'description', 'progress_type', 'progress_date'];
}
