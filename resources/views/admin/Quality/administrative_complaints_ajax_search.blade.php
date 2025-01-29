@if(@isset($data) and !@empty($data) and count($data)>0 )
    
    
@foreach ( $data as $info )
<main class="table">
   <section class="table__body">
<table id="example2">
   <thead>
      <tr>
      <th>      Date </th>
      <th>     Name </th>
      <th>     Complaint Title   </th>
      <th>    Complaint Status     </th>
   </tr>
   </thead>
   <tbody>
      <tr>
         <td>{{ $info->date }}</td>
         <td style="background-color: brown;color:white">{{ $info->added->name }}</td>
         <td>{{ $info->complaint_title }}</td>

         <td> 
            <select    name="complaint_status" id="complaint_status" complaint_id_value="{{ $info->id }}" class="form-control">
            <option  @if(old('complaint_status',$info->complaint_status)==0) selected  @endif  value="0"> Not reviewed    </option>
            <option @if(old('complaint_status',$info->complaint_status)==1) selected @endif  value="1">  reviewed </option>
            </select>
         </td> 

        
      </tr>
   
   </br>
   <tr>
      <td  colspan="4" style="text-align: center">
         {{ $info->complaint }}
      </td>
   </tr>

         
    
   </tbody>
</table>
</section>
</main>
@endforeach


<br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif