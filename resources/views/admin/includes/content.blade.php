<div class="content-wrapper">

    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color: #EF4C2B">@yield('contentheader')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item" style="color: #EF4C2B">@yield('contentheaderactivelink')</li>
              <li class="breadcrumb-item active" style="color: #EF4C2B">@yield('contentheaderactive')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
     <div class="row" style="background-color: #FBA82E;">
      @if(Session::has('error'))
      <div class="alert alert-danger text-right" role="alert">
      {{ Session::get('error') }}  
      </div>
   @endif
   @if(Session::has('success'))
   <div class="alert alert-success text-right" role="alert">
   {{ Session::get('success') }}  
   </div>
@endif


     @yield('content')
     
     
      

     </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>