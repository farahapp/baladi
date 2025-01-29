<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission_sub_menues extends Model
{
    use HasFactory;
    protected $table='permission_sub_menues';
    protected $guarded=[];

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }
     public function main_menue(){
      return $this->belongsTo('\App\Models\permission_main_menues','permission_main_menues_id');
   }
}
