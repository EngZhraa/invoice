<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class finances extends Model
{

    protected $guarded = [];

   
    public function gover(){
        return $this->belongsTo(govers::class,'benifit_comp_id','id');
    }
  
}
