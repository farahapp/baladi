<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $table = 'attendences';
    protected $fillable =[
        'sName',
        'sJobNo',
        'Date',
        'Time',
        'AttendanceStatus',        
    ];

    public function Employee(){
        return $this->belongsTo('\App\Models\Employee','sJobNo','ateendance_device_no');
     }

     public function Admin(){
        return $this->belongsTo('\App\Models\Admin','sJobNo','ateendance_device_no');
     }
  
}
