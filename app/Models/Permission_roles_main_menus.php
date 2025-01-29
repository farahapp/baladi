<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission_roles_main_menus extends Model
{
    use HasFactory;
    protected $table='permission_roles_main_menus';
    protected $guarded=[];

    public function permission_roles(){
        return $this->belongsTo('\App\Models\Permission_rols','permission_roles_id');
     }

     public function permission_main_menues(){
      return $this->belongsTo('\App\Models\Permission_main_menues','permission_main_menues_id');
   }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }
}
