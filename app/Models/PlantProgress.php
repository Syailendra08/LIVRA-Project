<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantProgress extends Model
{
    use SoftDeletes;
    protected $table = 'plant_progress';
    protected $primaryKey = 'progress_id'; // <---- INI WAJIB
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['category_id', 'plant_id', 'description', 'progress_type', 'progress_date'];
    public function plant()
{
    return $this->belongsTo(Plant::class);
}
 public function category()
    {
        return $this->belongsTo(PlantCategory::class, 'category_id');
    }
}
