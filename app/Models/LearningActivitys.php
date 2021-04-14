<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Methods;

class LearningActivitys extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'learning_activitys';
    protected $fillable = ['title','start_date','end_date','id_method'];

    public function methods(){
        return $this->belongsTo(Methods::class,'id_method','id')->withTrashed();
    }
}
