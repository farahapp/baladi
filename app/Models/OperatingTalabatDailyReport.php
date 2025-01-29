<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingTalabatDailyReport extends Model
{
    use HasFactory;
    protected $table = 'operating_talabat_daily_report';
    protected $guarded=[];

    public function Employee(){
        return $this->belongsTo('\App\Models\Employee','rider_id','operating_talabat_no');
     }

  
  
}
