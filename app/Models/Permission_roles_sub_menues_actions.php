<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission_roles_sub_menues_actions extends Model
{
    use HasFactory;
    protected $table='permission_roles_sub_menues_actions';
    protected $guarded=[];
    

    public function permission_sub_menues_actions(){
      return $this->belongsTo('\App\Models\Permission_sub_menues_actions','permission_sub_menues_actions_id');
   }

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }
}
