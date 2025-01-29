<?php

namespace App\Imports;

use App\Models\Attendence;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;

class AttendenceImport implements WithHeadingRow,ToCollection
{

 

    /**
    * @param Collection $rows
    */

   // use Importable;

   protected  $extension;

   public function __construct($extension)
   {
       $this->extension = $extension;
   }   
   
    
    public function collection(Collection $rows)
    {


        // Validator::make($rows->toArray(), [
        //     'sName' => 'required',
        // ])->validate();



        foreach ($rows as $row) 
        {
            if ($row['sname'] === null || $row['sname'] === "'NULL" || $row['attendancestatus'] === "undefined") {
                
              }else{

            $attendence =Attendence::where('sName',$row['sname'])
            ->where('sJobNo',$row['sjobno'])
            ->where('Date', $this->checkExtension( $row['date'])->format('Y-m-d'))
            ->where('Time',$this->checkExtension($row['time'])->format('H:i:s'))
            ->where('AttendanceStatus',$row['attendancestatus'])->first();

            if($attendence){

            }else{
                
                // $nullVal =Attendence::where('sName','LIKE',"%'NULL%")->first();
                // if($nullVal){

                // }else{
            Attendence::create([
                'sName' => $row['sname'],
                'sJobNo' => $row['sjobno'],
                'Date' => $this->checkExtension( $row['date'])->format('Y-m-d'),
                'Time' => $this->checkExtension($row['time'])->format('H:i:s'),
                'AttendanceStatus' => $row['attendancestatus'],     
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
