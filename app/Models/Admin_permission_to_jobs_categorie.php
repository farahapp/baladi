<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_permission_to_jobs_categorie extends Model
{
    use HasFactory;
    protected $table="admin_permission_to_jobs_categories";
    protected $guarded=[];

  
     public function jobs_categories(){
        return $this->belongsTo('\App\Models\jobs_categorie','jobs_categories_id');
     }
    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }
}
