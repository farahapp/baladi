@if(@isset($data) and !@empty($data) and count($data)>0 )
    
    
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead" style="background-color: purple;color:white">
      <th>   الرقم </th>
      <th>   الإسم </th>
      <th>       رقم الاقامة   </th>
      <th>      العمر   </th>
      <th>     رقم الهاتف   </th>
      <th>     رخصة سودانية   </th>
      <th>    تاريخ التسجيل      </th>
      
   
      <th></th>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td>{{ $info->id }}</td>
         <td>{{ $info->name }}</td>
         <td>{{ $info->id_number }}</td>
         <td>{{ $info->age }}</td>
         <td>{{ $info->phone_number }}</td>
         <td 
         @if ($info->does_has_sudanese_Driving_License==1) class="text-success" @else class="text-danger"  @endif > @if ($info->does_has_sudanese_Driving_License==1) توجد @else لا توجد  
         @endif
         </td>
         <td>{{ $info->registeration_date }}</td>
        

        
         <td>
            <a  href="{{ route('Marketing.edit',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
         </td>
      </tr>
      {{-- //////////////////////////////////////////////////////////// --}}
      
      {{-- ///////////////////////////////////////////////////////////////// --}}

    
      @endforeach
   </tbody>
</table>


         <br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif