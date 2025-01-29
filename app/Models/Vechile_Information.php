<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vechile_Information extends Model
{
    use HasFactory;
    protected $table='vechile_information';
    protected $guarded=[];

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }

     public function VechileDriver(){
      return $this->belongsTo('\App\Models\Employee','vechile_driver');
   }

   public function Vechile_Type(){
      return $this->belongsTo('\App\Models\Vechile_Type','vechile_type');
   }

   public function Vechile_Model(){
      return $this->belongsTo('\App\Models\Vechile_Model','vechile_model');
   }



     

}
