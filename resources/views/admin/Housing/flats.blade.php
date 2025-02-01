@extends('layouts.admin')
@section('title')
Apartment data
@endsection
@section('contentheader')
Housing List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Housing.flats') }}">     Apartments</a>
@endsection
@section('contentheaderactive')
show
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Apartment data   
            <a href="{{ route('Housing.flatscreate') }}" class="btn btn-sm btn-success">Add a new apartment</a>
         </h3>
      </div>
      <div class="card-body" id="ajax_responce_serachDiv" style="background-size: cover; background-image: url('{{ secure_asset('assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <main class="table">
            <section class="table__body">
             <table id="example2">
            <thead >
               <tr>
               <th>    Apartment number</th>
               <th>    Building number</th>
               <th>   beds Number </th>
               <th>   drivers Number    </th>
               <th>  Apartment Rating    </th>
               <th>  Apartment Status </th>
               <th></th>
            </tr>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->flat_No}}</td>
                  <td>{{ $info->bulding_no }}</td>
                  <td>{{ $info->bed_number }}</td>
                  <td>{{ $info->driver_number }}</td>


                  <td 
                  @if ($info->flat_range==1) class="text-success" @else class="text-danger"  @endif >
                  @if ($info->flat_range==1) excellent 
                  @elseif ($info->flat_range==2) very good
                  @elseif ($info->flat_range==3) acceptable 
                  @elseif ($info->flat_range==4) bad 
                  @else Very bad  
                  @endif
            
               
                     <td 
                     @if ($info->active==1) class="text-success" @else class="text-danger"  @endif > @if ($info->active==1) Ready @else Out of service  
                     @endif
                     </td>
               
                  <td>
                     <a  href="{{ route('Housing.flatsedit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">Edit</a>
                     <a  href="{{ route('Housing.flatsdestroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">Delete</a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </table>
   </section>
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
