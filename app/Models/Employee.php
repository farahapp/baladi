<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory,Notifiable;
   // protected $guard='driver';
   protected $table="employees";
    protected $guarded=[];
    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
     }
     public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
     }

   


     public function Driver_bank_process(){
      return $this->belongsTo('\App\Models\Driver_bank_process','driver_bank_process');
   }

   public function Driver_residency_process_status(){
      return $this->belongsTo('\App\Models\Residency_process_status','driver_residency_process_status');
   }

   public function Driving_school_status(){
      return $this->belongsTo('\App\Models\Driving_school_status','driving_school_status');
   }

   public function Nationalities(){
      return $this->belongsTo('\App\Models\Nationalitie','nationalities');
   }

   public function OperatingCompany(){
      return $this->belongsTo('\App\Models\Branche','branches');
   }

   public function Driver_vechile(){    
      return $this->hasOne(Vechile_Information::class, 'vechile_driver');
   }

   public function GeneralLoan(){    
      return $this->hasOne(GeneralLoan::class, 'driver_id');
   }
   

   public function SpecialLoan(){    
      return $this->hasOne(SpecialLoan::class, 'driver_id');
   }


   public function Flats(){    
      return $this->belongsTo('\App\Models\Flat','appartment_no');

     // return $this->hasOne(Flat::class, 'appartment_no	');
   }

   

     
}
