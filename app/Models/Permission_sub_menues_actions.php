<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission_sub_menues_actions extends Model
{
    use HasFactory;
    protected $table='permission_sub_menues_actions';
    protected $guarded=[];

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }   
     public function sub_menue(){
      return $this->belongsTo('\App\Models\permission_sub_menues','permission_sub_menues_id');
   }
}
