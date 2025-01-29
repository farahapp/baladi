<?php

namespace App\Imports;

use App\Models\Attendence;
use App\Models\OperatingTalabatDailyReport;
use App\Models\OperatingTalabatMonthlyReport;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;

class MonthlyTalabatReportImport implements WithHeadingRow,ToCollection
{

 
    

    /**
    * @param Collection $rows
    */

   // use Importable;

   protected  $extension;
   protected  $year;
   protected  $month;

   public function __construct($extension,$year,$month)
   {
       $this->extension = $extension;
       $this->year = $year;
       $this->month = $month;

   }   

   public function headingRow(): int
   {
       return 2;
   }
   
   public function startRow(): int
   {
       return 3;
   }

 
    
    public function collection(Collection $rows)
    {


        // Validator::make($rows->toArray(), [
        //     'sName' => 'required',
        // ])->validate();



        foreach ($rows as $row) 
        {
            if ($row['name'] === null || $row['name'] === "'NULL"  ) {
                
              }else{

            // $attendence =OperatingTalabatDailyReport::where('sName',$row['sname'])
            // ->where('sJobNo',$row['sjobno'])
            // ->where('Date', $this->checkExtension( $row['date'])->format('Y-m-d'))
            // ->where('Time',$this->checkExtension($row['time'])->format('H:i:s'))
            // ->where('AttendanceStatus',$row['attendancestatus'])->first();

            $attendence =OperatingTalabatMonthlyReport::where('year',$this->year)
            ->where('month',$this->month)
            ->where('name',$row['name'])
            ->where('talabat_id',$row['talabat_id'])
            ->where('last_batch_number',$row['last_batch_number'])
            ->where('working_days',$row['working_days'])
            ->where('actual_working_hours',$row['actual_working_hours'])
            ->where('total_orders',$row['total_orders'])
            ->where('late_login_shifts',$row['late_login_shifts'])
            ->where('no_show_shifts',$row['no_show_shifts'])
            ->where('no_show_execused_shifts',$row['no_show_execused_shifts'])
            ->where('no_days_lost',$row['nodays_lost'])
            ->where('n_day_off',$row['n_day_off'])
            ->where('reason',$row['reason'])->first();

            if($attendence){

            }else{
                
                // $nullVal =Attendence::where('sName','LIKE',"%'NULL%")->first();
                // if($nullVal){

                // }else{

                $talabat_id=$row['talabat_id'];
                $last_batch_number=$row['last_batch_number'];
                $working_days=$row['working_days'];
                $actual_working_hours=$row['actual_working_hours'];
                $total_orders=$row['total_orders'];
                $late_login_shifts=$row['late_login_shifts'];
                $no_show_shifts=$row['no_show_shifts'];
                $no_show_execused_shifts=$row['no_show_execused_shifts'];
                $no_days_lost=$row['nodays_lost'];
                $n_day_off=$row['n_day_off'];

                if($row['talabat_id'] === "-" ||$row['talabat_id'] === " "){
                    global $talabat_id;  
                    $talabat_id = '0';
                }else{
                    
                }
                if($row['last_batch_number'] === "-" ||$row['last_batch_number'] === " "){
                    global $last_batch_number;  
                    $last_batch_number = '0';
                }
                if($row['working_days'] === "-" ||$row['working_days'] === " "){
                    global $working_days;  
                    $working_days = '0';
                }
                if($row['actual_working_hours'] === "-" ||$row['actual_working_hours'] === " "){
                    global $actual_working_hours;  
                    $actual_working_hours = '0';
                }
                if($row['total_orders'] === "-" ||$row['total_orders'] === " "){
                    global $total_orders;  
                    $total_orders = '0';
                }
                if($row['late_login_shifts'] === "-" ||$row['late_login_shifts'] === " "){
                    global $late_login_shifts;  
                    $late_login_shifts = '0';
                }
                if($row['no_show_shifts'] === "-" ||$row['no_show_shifts'] === " "){
                    global $no_show_shifts;  
                    $no_show_shifts = '0';
                }
                if($row['no_show_execused_shifts'] === "-" ||$row['no_show_execused_shifts'] === " "){
                    global $no_show_execused_shifts;  
                    $no_show_execused_shifts = '0';
                }
                if($row['nodays_lost'] === "-" ||$row['nodays_lost'] === " "){
                    global $no_days_lost;  
                    $no_days_lost = '0';
                }
                if($row['n_day_off'] === "-" ||$row['n_day_off'] === " "){
                    global $n_day_off;  
                    $n_day_off = '0';
                }
              



            OperatingTalabatMonthlyReport::create([
                'year' => $this->year,
                'month' => $this->month,
                'name' => $row['name'],
                'talabat_id' => $talabat_id,
                'last_batch_number' => $last_batch_number,     
                'working_days' => $working_days,     
                'actual_working_hours' => $actual_working_hours,     
                'total_orders' => $total_orders,     
                'late_login_shifts' => $late_login_shifts,     
                'no_show_shifts' => $no_show_shifts,     
                'no_show_execused_shifts' => $no_show_execused_shifts,     
                'no_days_lost' => $no_days_lost,     
                'n_day_off' => $n_day_off,     
                'reason' => $row['reason'],     
            ]);
         }
        }

        }
    }


   
    
    private function  checkExtension($dateTime)
   {
       switch ($this->extension) {
           case 'csv':
               return Carbon::parse($dateTime);
               break;
           case 'xlsx':
           case 'xsl':
               return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateTime);
               break;
       }
    }

}
