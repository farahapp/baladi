<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title> بحث السائقين </title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
   <style>
      @media print {
         .hidden-print {
            display: none;
         }
      }

      @media print {
         #printButton {
            display: none;
         }
      }

      td {
         font-size: 15px !important;
         text-align: center;
      }
      th{
         text-align: center;
      }
   </style>

<body style="padding-top: 10px;font-family: tahoma;">


   <table style="width: 60%;float: right;  margin-right: 5px;" dir="rtl">
    
      <tr>
         <td style="text-align: center;padding: 5px;font-weight: bold;"> <span style=" display: inline-block;
               width: 500px;
               height: 30px;
               text-align: center;
               color: red;
               border: 1px solid black;border-radius: 10px !important ">
               بحث السائقين   
            </span>
         </td>
      </tr>
      <tr>
         <td style="text-align: center;padding: 5px;font-weight: bold;">
            <span style=" display: inline-block;
                  width: 400px;
                  height: 30px;
                  text-align: center;
                  color: blue;
                  border: 1px solid black;border-radius: 10px !important ">
               طبع بتاريخ @php echo date('Y-m-d'); @endphp
            </span>
         </td>
      </tr>
      <tr>
         <td style="text-align: center;padding: 5px;font-weight: bold;">
            <span style=" display: inline-block;
                  width: 400px;
                  height: 30px;
                  text-align: center;
                  color: blue;
                  border: 1px solid black;border-radius: 10px !important ">
               طبع بواسطة {{ auth()->user()->name }}
            </span>
         </td>
      </tr>
   </table>
   <table style="width: 35%;float: right; margin-left: 5px; " dir="rtl">
      <tr>
         <td style="text-align:left !important;padding: 5px;">
            <img style="width: 150px; height: 110px; border-radius: 10px;"
               src="{{ asset('assets/admin/uploads').'/'.$systemData['image'] }}">
            <p>{{ $systemData['company_name'] }}</p>
         </td>
      </tr>
   </table>

   <br>

   @if (@isset($data) && !@empty($data) )
   <table dir="rtl" id="example2" class="table table-bordered table-hover" style="width: 99%;margin: 0 auto;">
      <thead  style="background-color: yellow">
        
            <th style="width: 5%;">الرقم</th>
            <th style="width: 30%;">{{ __('mycustom.driver_name') }}</th>
            <th style="width: 10%;">نوع المركبة</th>
            <th style="width: 10%;">موديل المركبة</th>
            <th style="width: 15%;"> الجنسية</th>
            <th style="width: 15%;"> نوع العقد </th>
            <th style="width: 15%;"> المشغل  </th>

            

     
         </thead>


      </thead>
      <tbody>
         @php $i=1; @endphp
         @foreach ( $data as $info )
         <tr>
            <td>{{ $i }}</td>
            <td>{{ $info->driver_name }}</td>
            <td  @if ($info->Driver_vechile!='') class="text-success" @else class="text-warning"  @endif>
               @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
               
               @if ($info->Driver_vechile->vechile_car_or_bike==1) سيارة  @else دراجة نارية   
               @endif

               {{-- {{ $info->Driver_vechile->vechile_car_or_bike }} --}}

               @else
               لايوجد 
               @endif
               </td>
            {{-- @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile) and $other['vechile_model'][$info->Driver_vechile->vechile_model]['id'] ==  $info->Driver_vechile->vechile_model ) --}}
            <td  @if ($info->Driver_vechile!='') class="text-success" @else class="text-warning"  @endif>
             @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
             {{ $other['vechile_model'][$info->Driver_vechile->vechile_model-1]['name'] }}
            {{-- @if (@isset($info->Driver_vechile->vechile_model) && !@empty($info->Driver_vechile->vechile_model)) --}}
            {{-- @php --}}
            {{-- // $array = App\Vechile_Model::Select(id)->get(); --}}
           {{-- //   $value = App\Vechile_Model::select("id")->where($id,"=",$info->Driver_vechile->vechile_model)->first()  --}}
            {{-- @endphp --}}
            @else
            لايوجد 
            @endif
            </td>


            <td>{{ $info->Nationalities->name }}</td>

            {{-- <td>{{ $info->driver_residency_permit_id }}</td> --}}

            {{-- $other['vechile_information'] --}}


               {{-- <td 
               @if ($info->appointment_type==1) class="text-success" @else class="text-warning"  @endif > @if ($info->appointment_type==1) قادم من البلد الام  @else من داخل قطر (داخلي)    
               @endif
               </td> --}}

               <td>
                  <select   name="operating_contract_type" id="operating_contract_type" driver_id_value="{{ $info->id }}" class="form-control">
                     <option   @if(old('operating_contract_type',$info['operating_contract_type'])=="") selected @endif  value=""> إختر نوع العقد</option>
                     <option   @if(old('operating_contract_type',$info['operating_contract_type'])==1 and old('operating_contract_type',$info['operating_contract_type'])!="") selected @endif  value="1">عقد حر</option>
                     <option   @if(old('operating_contract_type',$info['operating_contract_type'])==2 and old('operating_contract_type',$info['operating_contract_type'])!="") selected @endif  value="2">800 ريال</option>
                   </select>
               </td>

               <td>
                  <select   name="operating_company" id="operating_company" driver_id_value="{{ $info->id }}" class="form-control">s
                     <option   @if(old('operating_company',$info['operating_company'])=="") selected @endif  value=""> إختر المشغل</option>
                     <option   @if(old('operating_company',$info['operating_company'])==1 and old('operating_company',$info['operating_company'])!="") selected @endif  value="1"> Baladi</option>
                     <option   @if(old('operating_company',$info['operating_company'])==2 and old('operating_company',$info['operating_company'])!="") selected @endif  value="2"> External operating company</option>
                   </select>
               </td>

             
         
         </tr>
         @php $i++; @endphp
         @endforeach
      </tbody>
   </table>
   <br>

   @else
 <div class="clearfix"></div>
      <p class="" style="text-align: center; font-size: 16px;font-weight: bold; color: brown">
      عفوا لاتوجد بيانات لعرضها !!
      </p>

   @endif


   <br>
   <p style="
         padding: 10px 10px 0px 10px;
         bottom: 0;
         width: 100%;
         /* Height of the footer*/ 
         text-align: center;font-size: 16px; font-weight: bold;
         "> {{ $systemData['address'] }} - {{ $systemData['phones'] }} </p>
   <div class="clearfix"></div> <br>
   <p class="text-center">
      <button onclick="window.print()" class="btn btn-success btn-sm" id="printButton">طباعة</button>
   </p>
</body>

</html>