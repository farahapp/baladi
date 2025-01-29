<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vechile_Model extends Model
{
    use HasFactory;
    protected $table='vechile_model';
    protected $guarded=[];

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }

     public function VechileType(){
      return $this->belongsTo('\App\Models\Vechile_Type','vechile_type');
   }

     

}
