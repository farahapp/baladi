@extends('layouts.admin')
@section('title')
Financial
@endsection
@section('contentheader')
Financial Statement
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">     Drivers</a>
@endsection
@section('contentheaderactive')
show
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Drivers Data   
         </h3>
      </div>
      <div class="card-body" id="ajax_responce_serachDiv" style="background-size: cover; background-image: url('{{ secure_asset('assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <main class="table">
            <section class="table__body">
         <table id="example2" >
            <thead>
               <tr>
               <th>    Driver's name</th>
               <th>  Loans No </th>
               <th>   Loans Amount </th>
               <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->driver_name }}</td>
             
                  


      
            



                  <td>{{ \App\Models\SpecialLoan::where('driver_id',$info->id)->count() }}</td>


                  <td>{{ \App\Models\SpecialLoan::where('driver_id',$info->id)->sum('loan_value') }}</td>

                  {{-- <td>{{\App\SpecialLoan::sum('loan_value')}} --}}



                   



               
                  <td>
                     <a  href="{{ route('financial.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">Driver's Financial Notes</a>
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
         <p class="bg-danger text-center">Sorry, there is no data to display.</p>
         @endif
      </div>
   </div>
</div>
@endsection