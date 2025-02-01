@extends('layouts.admin')
@section('title')
Operating companies
@endsection
@section('contentheader')
Setting menu
@endsection
@section('contentheaderactivelink')
<a href="{{ route('branches.index') }}">   Operating companies</a>
@endsection
@section('contentheaderactive')
show
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">    Operating companies Data 
            <a href="{{ route('branches.create') }}" class="btn btn-sm btn-warning">Add New</a>
         </h3>
      </div>
      <div class="card-body" style="background-size: cover; background-image: url('{{ secure_asset('assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) )
         <main class="table">
            <section class="table__body">
         <table id="example2">
            <thead>
               <tr>
               <th>  No </th>
               <th>  Name</th>
               <th>   Address</th>
               <th>   phone</th>
               <th>   email</th>
               <th>   Activation status</th>
               <th>   Add By</th>
               <th>   Updated By</th>
               <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td> {{ $info->id }} </td>
                  <td> {{ $info->name }} </td>
                  <td> {{ $info->address }} </td>
                  <td> {{ $info->phones }} </td>
                  <td> {{ $info->email }} </td>
                  <td @if ($info->active==1) class="text-success" @else class="text-danger"  @endif      > @if ($info->active==1) Activated @else Disabled @endif</td>
                  <td>{{ $info->added->name }} </td>
                  <td>
                     @if($info->updated_by>0)
                     {{ $info->updatedby->name }} 
                     @else
                     nothing
                     @endif
                  </td>
                  <td>
                     <a  href="{{ route('branches.edit',$info->id) }}" class="btn btn-success btn-sm">Edit</a>
                     <a  href="{{ route('branches.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">Delete</a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </section>
   </main>
         @else
         <p class="bg-danger text-center"> Sorry, there is no data to display.</p>
         @endif
      </div>
   </div>
</div>
@endsection
