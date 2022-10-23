<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    

    protected $guarded = [];


    public function company(){
        return $this->belongsTo(companies::class,'excut_comp','id');
    }
   
    public function finance(){
        return $this->belongsTo(finances::class,'fin_id','id');
    }

}