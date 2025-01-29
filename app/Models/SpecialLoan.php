<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialLoan extends Model
{
    use HasFactory;
    protected $table='specialloans';
    protected $guarded=[];


    
    
    public function Driver_id(){
      return $this->belongsTo('\App\Models\Employee','driver_id');
   }

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }
     
     
}
