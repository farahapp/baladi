<?php
$lang = app()->getLocale()=="ar"? '-rtl' : '';
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
{{-- <html lang="en"> --}}
<html lang="{{ app()->getLocale() }}"
      data-textdirection="{{ app()->getLocale()=="ar" ? 'rtl' : 'ltr' }}"
>

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> @yield('title') </title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ secure_asset('assets/admin/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ secure_asset('assets/admin/fonts/SansPro/SansPro.min.css') }}">


  @if (app()->getLocale()=='ar')
    <link rel="stylesheet" href="{{ secure_asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css') }}">
  @else
  <link rel="stylesheet" href="{{ secure_asset('assets/admin/css/bootstrap-4.0.0-dist/css/bootstrap.min.css') }}">
  @endif
     


  <link rel="stylesheet" href="{{ secure_asset('assets/admin/css/mycustomstyle.css') }}">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
  <div class="pre-loader" id="pre-loader"></div>

<div class="wrapper">


  <!-- Navbar -->
@include('admin.includes.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="{{ Route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale' =>__('mycustom.lan_code'),'id'=>Route::currentRouteName()->segments())->last()]) }}" class="brand-link"> --}}
      {{-- @if (Route::currentRouteName()->route('id'))
        
      @endif --}}
      <a  class="brand-link">
        <img src="{{ secure_asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
           {{-- <p href="{{ Route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale' =>__('mycustom.lan_code'),0]) }}" class="brand-text font-weight-light">{{ __('mycustom.language') }}  </p> --}}
           <p style="font-size: 1.4vw; color:brown"  class="brand-text font-weight-light">Baladi Express  </p>
           {{-- <p href="{{ Route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale' =>__('mycustom.lan_code'),'id'=>=>Route::currentRouteName()->segments())->last()]) }}" class="brand-text font-weight-light">{{ __('mycustom.language') }}  </p> --}}
          </a>

    <!-- Sidebar -->
  @include('admin.includes.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 @include('admin.includes.content')
  <!-- /.content-wrapper -->

 

  <!-- Main Footer -->
@include('admin.includes.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ secure_asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ secure_asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ secure_asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ secure_asset('assets/admin/js/General.js') }}"></script>
@yield('script')

<script type="text/javascript">

var loader;
function loadNow(opacity) {
  if(opacity <= 0){
   // displayContent();
   loader.style.display ="none";

  }
  else {
    loader.style.opacity =opacity;
    window.setTimeout(function() {
      loadNow(opacity - 0.05)
    }, 30);

  }
}

function displayContent() {
        loader.style.display ="none";
        document.getElementById("pre-loader").style.display ='block';
}


document.addEventListener("DOMContentLoaded",function(){
  loader =document.getElementById("pre-loader");
  loadNow(1);
});


  //////////////////////////////
// var loader =document.getElementById("pre-loader");
// window.addEventListener("load",function(){
//     setTimeout(function(){
//       loader.style.display ="none";

//     },1500);
// });


///////////////////////////////////////

// window.addEventListener("load",() => {
//   conist loader =document.querySelector(".pre-loader");

//   loader.classList.add("loader-hidden");

//   loader.addEventListener("transitionend",()={
//     document.body.removeChild("pre-loader");
//           loader.style.display ="none";

//   })
// })

</script>

</body>
</html>
