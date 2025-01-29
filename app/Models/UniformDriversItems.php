<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniformDriversItems extends Model
{
    use HasFactory;
    protected $table="uniform_drivers_items";
    protected $guarded=[];
    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }

     public function driver(){
      return $this->belongsTo('\App\Models\Employee','drivers_number');
   }
}
