<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingTalabatMonthlyReport extends Model
{
    use HasFactory;
    protected $table = 'operating_talabat_monthly_report';
    protected $guarded=[];

    public function Employee(){
        return $this->belongsTo('\App\Models\Employee','talabat_id','operating_talabat_no');
     }


  
}
