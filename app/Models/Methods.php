<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\LearningActivitys;

class Methods extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'methods';
    protected $fillable = ['name'];

    public function activitys(){
        return $this->hasMany(LearningActivitys::class, 'id_method', 'id');
    }
}
