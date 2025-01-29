<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vechile_Spare_Parts extends Model
{
    use HasFactory;
    protected $table='vechile_spare_parts';
    protected $guarded=[];

    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }

}
