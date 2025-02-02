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
            <th>Deposits Status</th>
            <th></th>
         </tr>
         </thead>
         <tbody>
            @foreach ( $data as $info )
            <tr>
               <td>{{ (($data->firstItem() + $loop->index))  }}</td>
               {{-- للترتيب التنازلي نستخدم الدالة التحت
               <td>{{ $data->firstItem() + ($data->count() - $loop->index)}}</td>  --}}
               <td>{{ $info->driver_name }}</td>
               {{-- <td><img src="{{ asset('/../assets/admin/uploads').'/'.$info->driver_photo }}" width="50" class="img-thumbnail rounded-circle"></td> --}}
               <td><img src="{{ asset('/../assets/admin/uploads').'/'.$info->driver_photo }}"></td>
               <td>{{ $info->baladi_id }}</td>

               <td><strong>{{ $info->Nationalities->name }}</strong></td>

          


               <td> 
                  @foreach ( $uniformDrivers as $uniformDriversVal )
                  @if( $uniformDriversVal->driver_id ==  $info->id )
                 @if ($uniformDriversVal->report_status!=1)
                 <p class="bg-danger text-center"> uniform not returend</p>
                 @break
                 {{-- @else
                 <p class="bg-success text-center"> all order returend</p> --}}
                 {{-- @break --}}

                 @endif
                  @endif
                  @endforeach
               </td>





            
               <td>
                  <a  href="{{ route('uniform.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B" >Add Uniform</a>
                  {{-- <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
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