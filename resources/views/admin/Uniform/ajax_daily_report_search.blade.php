@if(@isset($data) and !@empty($data) and count($data)>0 )
    
<main class="table">
   {{-- <section class="table__header">
      Drivers Deposit
   </section> --}}
   <section class="table__body">
      <table>
         <thead>
            <tr>
            <th>No  </th>
            <th>{{ __('mycustom.driver_name') }}</th>
            <th>Image</th>
            <th>{{ __('mycustom.driver_baladi_id') }}</th>
            <th>{{ __('mycustom.nationalty') }}</th>
            <th>Uniforms Status</th>
            {{-- <th></th> --}}
         </tr>
         </thead>
         <tbody>
            @foreach ( $data as $info )
            <tr>
               <td>{{ (($data->firstItem() + $loop->index))  }}</td>
               {{-- للترتيب التنازلي نستخدم الدالة التحت
               <td>{{ $data->firstItem() + ($data->count() - $loop->index)}}</td>  --}}
               <td>{{ $info->driver_name }}</td>
               {{-- <td><img src="{{ secure_asset('assets/admin/uploads').'/'.$info->driver_photo }}" width="50" class="img-thumbnail rounded-circle"></td> --}}
               <td><img src="{{ secure_asset('assets/admin/uploads').'/'.$info->driver_photo }}"></td>
               <td>{{ $info->baladi_id }}</td>

               <td><strong>{{ $info->Nationalities->name }}</strong></td>

          

                  {{-- <td> 
                     @foreach ( $driversUniform as $driversUniformVal )
                     @if( $driversUniformVal->driver_id ==  $info->id )
                     <p class="bg-danger text-center"> old order not returend</p>
                      @break --}}

                     {{-- @else
                     <p class="bg-success text-center"> all order returend</p> --}}
                     {{-- @endif
                     @endforeach
                  </td> --}}


                  <td> 
                     @foreach ( $driversUniform as $driversUniformVal )
                     @if( $driversUniformVal->driver_id ==  $info->id )
                    @if ($driversUniformVal->report_status!=1)
                    <p class="bg-danger text-center"> old order not returend</p>
                    @break
                    {{-- @else
                    <p class="bg-success text-center"> all order returend</p> --}}
                    {{-- @break --}}

                    @endif
                     @endif
                     @endforeach
                  </td>



            
               {{-- <td>
                  <a  href="{{ route('SecurityGuard.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">Add Uniform</a>
               </td> --}}
            </tr>

            <tr>
               <td colspan="7">

                  {{-- <p style="text-align: center;font-size: 1.4vw; color:brown">عمليات الصيانة التي تمت لهذه المركبة 
                     <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_maintenance_to_vehicle btn-info" >اضافة صيانة للمركبة</button>
                  </p> --}}
                  
                  @foreach ( $driversUniform as $driversUniformVal )

                  @if(@isset($driversUniform) and !@empty($driversUniform) and $driversUniformVal['driver_id'] ==  $info->id )
                  {{-- <main class="table"> --}}
                     <section class="table__body">
                  <table>
                  <thead style="color:brown">
                     <th>     Uniform Date </th>
                     <th>     Uniform Time </th>
                     <th>     Uniform status   </th>
                  </thead>
                  <tbody>
            
                     {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                     <tr>
                        <td style="color: brown;">{{ $driversUniformVal->date }}</td>

                        {{-- <td style="color: brown;">{{ $driversUniformVal->created_at }}</td> --}}

                        <td>
                           @php
                           $dt=new DateTime($driversUniformVal->created_at);
                           $date=$dt->format("Y-m-d");
                           $time=$dt->format("h:i");
                           $newDateTime=date("A",strtotime($driversUniformVal->created_at));
                           $newDateTimeType= (($newDateTime=='AM')?'AM ':'PM'); 
                           @endphp
                           {{-- {{ $date }} <br> --}}
                           {{ $time }}
                           {{ $newDateTimeType }}  <br>
                        </td>


                        {{-- <td 
                        @if ($driversUniformVal->report_status==1) class="text-success" @else class="text-danger"  @endif >
                        @if ($driversUniformVal->report_status==1) Returned Uniform 
                        @elseif ($driversUniformVal->report_status==0) Returned Uniform 
                        @endif --}}

                        
                        {{-- <td>{{ $driversUniformVal->report_status }}</td> --}}


                        <td> 
                           <select    name="report_status" id="report_status" report_id_value="{{ $driversUniformVal->id }}" class="form-control">
                           <option  @if(old('report_status',$driversUniformVal->report_status)==0) selected  @endif  value="0">Not Returned Uniform </option>
                           <option @if(old('report_status',$driversUniformVal->report_status)==1) selected @endif  value="1">Returned Uniform</option>
                           </select>
                        </td> 
                        
                     </tr>

                       {{---------------------------------------------}}
         <tr>
            <td  colspan="5" style="text-align: center">
            @foreach ($driversUniformItems as $UniformItem )
            @if (@isset($driversUniformItems) && !@empty($driversUniformItems)  &&  $UniformItem->daily_employees_report_id == $driversUniformVal->id )
            <a class="btn btn-sm " style="background-color: #EF4C2B;color:white">{{"(".$UniformItem->amount.")".$UniformItem->name."(".$UniformItem->size.")" }}<i class="fa fa-trash " aria-hidden="true"></i></a>
            @endif
            @endforeach
         </td>
         </tr>
            {{---------------------------------------------}}

                  </tr>
                    

                  </tbody>
               </table>
            </section>
         {{-- </main> --}}

               @else
               {{-- <p class="bg-danger text-center"> عفوا لاتوجد صلاحيات مضافة لعرضها</p> --}}
               @endif
               @endforeach

                  </td>
                  </tr>




            @endforeach

         </tbody>
      </table>
      
   </section>
</main>

         <br>
         

         <div class="col-md-12 text-center" id="the_legal_ajax_pagination_in_search">
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif