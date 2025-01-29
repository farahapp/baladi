<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin_permission_to_employees extends  Authenticatable
{
    use HasFactory;
    protected $table="admin_permission_to_employees";
    protected $fillable=[
      'admin_id', 'employees_id', 'active', 'com_code', 'date', 'added_by', 'updated_by', 'created_at', 'updated_at'
    ];



     public function admin(){
      return $this->belongsTo('\App\Models\Admin','admin_id');
   }

   public function employee(){
      return $this->belongsTo('\App\Models\Employee','employees_id');
   }

   public function added(){
      return $this->belongsTo('\App\Models\Admin','added_by');
   }

     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }

}
