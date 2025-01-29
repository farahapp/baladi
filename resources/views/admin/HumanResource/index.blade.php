@extends('layouts.admin')
@section('title')
Drivers data
@endsection
@section('contentheader')
Drivers List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">{{ __('mycustom.drivers') }}</a>
@endsection
@section('contentheaderactive')
show
@endsection

@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  {{ __('mycustom.drivers_information') }}   
            <a href="{{ route('HumanResource.create') }}" class="btn btn-sm btn-info">{{ __('mycustom.add_new_driver') }}</a>
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_search_url" value="{{route('HumanResource.ajax_search')}}">

         </h3>
      </div>

      
      <div class="row" style="padding: 5px;">


         
         {{-- <div class="col-md-3">
            <div class="form-group">
               <label>  Search by name </label>
               <input type="text"  autofocus id="search_by_text" class="form-control" value="" placeholder="بحث بالاسم">
            </div>
         </div> --}}


         <div class="col-md-3">
            <div class="form-group">
               <input checked type="radio" name="searchbyradio" id="searchbyradio" value="baladi_id"> Baladi Id
            <input  type="radio" name="searchbyradio" value="name"> Name
            <input type="radio" name="searchbyradio" id="searchbyradio" value="phone_number"> Phone
            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>
        

      <div class="col-md-3">
         <div class="form-group">
            <label>  Search by Operating Company </label>
            <select name="search_by_operating_company" id="search_by_operating_company" class="form-control select2 ">
               <option  value="all">All  </option>
               @if (@isset($other['branches']) && !@empty($other['branches']))
               @foreach ($other['branches'] as $info )
               <option value="{{ $info->id }}"> {{ $info->name }} </option>
               @endforeach
               @endif
            </select>
            @error('search_by_operating_company')
            <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>


         <div class="col-md-3">
            <div class="form-group">
               <label> Residence expiry year    </label>
               <select   name="year" id="year" class="form-control">
                  <option  value="all">Search all </option>
                  <option  value={{ \Carbon\Carbon::now()->year-1 }}>{{ \Carbon\Carbon::now()->year-1 }} </option>
                  <option  value={{ \Carbon\Carbon::now()->year }}> {{ \Carbon\Carbon::now()->year }}</option>
                  <option  value={{ \Carbon\Carbon::now()->year+1 }}> {{ \Carbon\Carbon::now()->year+1 }}</option>
            </select>
            </div>
         </div>

    


         <div class="col-md-4">
            <div class="form-group">
               <label>  Search by residence expiration month </label>
                  <select name="months[]" multiple id="months" class="form-control select2 " >
                     {{-- <option  value="" >اختر السائقين </option> --}}
                     {{-- <option  value="all">البحث بالكل </option> --}}
                     <option   value="01">January </option>
                     <option   value="02">February </option>
                     <option   value="03">March </option>
                     <option   value="04">April </option>
                     <option   value="05">May </option>
                     <option   value="06">June </option>
                     <option   value="07">July </option>
                     <option   value="08">August </option>
                     <option   value="09">September </option>
                     <option   value="10">October </option>
                     <option   value="11">November </option>
                     <option   value="12">December </option>
                  </select>
            </div>
         </div>


         
        

      </div>


      <div class="card-body" id="ajax_responce_serachDiv" style="background-size: cover; background-image: url('{{ asset('/../assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <main class="table">
            <section class="table__body">
         <table id="example2">
            <thead>
               <tr>
               <th>No  </th>
               <th>{{ __('mycustom.driver_name') }}</th>
               <th>Image</th>
               {{-- <th>{{ __('mycustom.driver_pasport_no') }}</th> --}}
               <th>{{ __('mycustom.driver_baladi_id') }}</th>
               <th>{{ __('mycustom.nationalty') }}</th>
               {{-- <th>{{ __('mycustom.signing_initial_contract') }}</th> --}}
               {{-- <th>{{ __('mycustom.signing_all_contract_and_debt') }}</th> --}}
               {{-- <th>{{ __('mycustom.arrive_qater_date') }}</th> --}}
               {{-- <th>{{ __('mycustom.give_passport') }}</th> --}}
               {{-- <th>{{ __('mycustom.signing_main_contract') }}</th>
               <th>{{ __('mycustom.signing_full_financial_debt') }}</th>
               <th>{{ __('mycustom.signing_penalty_clause') }}</th> --}}
               {{-- <th>{{ __('mycustom.driver_bank_process') }}</th> --}}
               <th>Operating Company</th>
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
                  <td><img src="{{ asset('/../assets/admin/uploads').'/'.$info->driver_photo }}"></td>
                  <td>{{ $info->baladi_id }}</td>

                  <td>{{ $info->Nationalities->name }}</td>

             
                  {{-- <td 
                  @if ($info->isSigningInitialContract!=1
                  || $info->isGivePassPort!=1
                  || $info->isSigningMainContract!=1
                  || $info->isSigningFullFinancialDebt!=1
                  || $info->isSigningPenaltyClause!=1
                  ) class="text-danger" @else class="text-success"  @endif >
                   @if ($info->isSigningInitialContract!=1
                     || $info->isGivePassPort!=1
                  || $info->isSigningMainContract!=1
                  || $info->isSigningFullFinancialDebt!=1
                  || $info->isSigningPenaltyClause!=1
                   ) غير موقع @else  موقع 
                  @endif
                  </td> --}}

                  
                     {{-- <td 
                     @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") class="bg-danger" @else class="bg-success"  @endif > @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") خارج قطر @else داخل قطر  
                     @endif
                     </td> --}}

          



                     {{-- <td 
                     @if ($info->appointment_type==1) class="text-success" @else class="text-warning"  @endif > @if ($info->appointment_type==1) Coming from home country  @else From within Qatar (internal)    
                     @endif
                     </td> --}}


              

                     @if(@isset($info->OperatingCompany->name) and !@empty($info->OperatingCompany->name) )
                      <td>{{ $info->OperatingCompany->name }}</td>
            
                        @else
                        <td>Not Selected</td>
                        @endif


                     {{-- <td>{{ $info->OperatingCompany->name }}</td> --}}




               
                  <td>
                     <a  href="{{ route('HumanResource.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">Update driver data</a>
                     {{-- <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </section>
   </main>
         <br>
         <div class="col-md-12 text-center">
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> Sorry, there is no data to display.</p>
         @endif
      </div>
   </div>
</div>
@endsection
@section("script")
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/js/human_resource.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });
</script>
@endsection
{{-- ===================================================== --}}