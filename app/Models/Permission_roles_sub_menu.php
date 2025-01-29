<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission_roles_sub_menu extends Model
{
    use HasFactory;
    protected $table='permission_roles_sub_menu';
    protected $guarded=[];

    public function permission_sub_menues(){
      return $this->belongsTo('\App\Models\Permission_sub_menues','permission_sub_menues_id');
   }

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }
}
