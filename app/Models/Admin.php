<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends  Authenticatable
{
    use HasFactory;
    protected $table="admins";
    protected $fillable=[
       'name','email','username','password','added_by','updated_by','active','date','created_at','updated_at','com_code','permission_roles_id','is_master_Admin'

    ];

    public function permission_rols(){
      return $this->belongsTo('\App\Models\Permission_rols','permission_roles_id');
   }

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }

}
