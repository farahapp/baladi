<?php

namespace App\Imports;

use App\Models\Attendence;
use App\Models\OperatingTalabatDailyReport;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;

class DailyTalabatReportImport implements WithHeadingRow,ToCollection
{

 
    

    /**
    * @param Collection $rows
    */

   // use Importable;

   protected  $extension;
   protected  $date;

   public function __construct($extension,$date)
   {
    $this->extension = $extension;
    $this->date = $date;
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

            $attendence =OperatingTalabatDailyReport::where('date',$this->date)
            ->where('name',$row['name'])
            ->where('rider_id',$row['rider_id'])
            ->where('last_batch',$row['last_batch'])
            ->where('actual_working',$row['actual_working'])
            ->where('orders',$row['orders'])
            ->where('loss_orders',$row['loss_orders'])
            ->where('loss_hours',$row['loss_hours'])
            ->where('late_login',$row['late_login'])
            ->where('no_show',$row['no_show'])
            ->where('no_show_execused',$row['no_show_execused'])
            ->where('oerders',$row['oerders'])
            ->where('noets',$row['noets'])->first();

            if($attendence){

            }else{
                
                // $nullVal =Attendence::where('sName','LIKE',"%'NULL%")->first();
                // if($nullVal){

                // }else{

                $rider_id=$row['rider_id'];
                $last_batch=$row['last_batch'];
                $actual_working=$row['actual_working'];
                $orders=$row['orders'];
                $loss_orders=$row['loss_orders'];
                $loss_hours=$row['loss_hours'];
                $late_login=$row['late_login'];
                $no_show=$row['no_show'];
                $no_show_execused=$row['no_show_execused'];
                $oerders=round(((int)$row['orders']/18)*100, 2);

                // function updateVar(&$variable) {
                //     $variable = '0';
                // }


                if($row['rider_id'] === "-" ||$row['rider_id'] === " "){
                    global $rider_id;  
                    $rider_id = '0';
                }else{
                    
                }
                if($row['last_batch'] === "-" ||$row['last_batch'] === " "){
                    global $last_batch;  
                    $last_batch = '0';
                }
                if($row['actual_working'] === "-" ||$row['actual_working'] === " "){
                    global $actual_working;  
                    $actual_working = '0';
                }
                if($row['orders'] === "-" ||$row['orders'] === " "){
                    global $orders;  
                    $orders = '0';
                }
                if($row['loss_orders'] === "-" ||$row['loss_orders'] === " "){
                    global $loss_orders;  
                    $loss_orders = '0';
                }
                if($row['loss_hours'] === "-" ||$row['loss_hours'] === " "){
                    global $loss_hours;  
                    $loss_hours = '0';
                }
                if($row['late_login'] === "-" ||$row['late_login'] === " "){
                    global $late_login;  
                    $late_login = '0';
                }
                if($row['no_show'] === "-" ||$row['no_show'] === " "){
                    global $no_show;  
                    $no_show = '0';
                }
                if($row['no_show_execused'] === "-" ||$row['no_show_execused'] === " "){
                    global $no_show_execused;  
                    $no_show_execused = '0';
                }
                if($row['oerders'] === "-" ||$row['oerders'] === " "){
                    global $oerders;  
                    $oerders = '0';
                }
                

                // OperatingTalabatDailyReport::create([
                //     'date' => $this->date,
                //     'name' => $row['name'],
                //     'rider_id' => $row['rider_id'],
                //     'last_batch' => $row['last_batch'],     
                //     'actual_working' => $row['actual_working'],     
                //     'orders' => $row['orders'],     
                //     'loss_orders' => $row['loss_orders'],     
                //     'loss_hours' => $row['loss_hours'],     
                //     'late_login' => $row['late_login'],     
                //     'no_show' => $row['no_show'],     
                //     'no_show_execused' => $row['no_show_execused'],     
                //     'oerders' => $row['oerders'],     
                //     'noets' => $row['noets'],     
                // ]);

                OperatingTalabatDailyReport::create([
                    'date' => $this->date,
                    'name' => $row['name'],
                    'rider_id' => $rider_id,
                    'last_batch' => $last_batch,
                    'actual_working' => $actual_working,
                    'orders' => $orders, 
                    'loss_orders' => $loss_orders,   
                    'loss_hours' => $loss_hours,
                    'late_login' => $late_login,
                    'no_show' => $no_show,
                    'no_show_execused' => $no_show_execused,
                    'oerders' => $oerders,  
                    'noets' => $row['noets'],     
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
