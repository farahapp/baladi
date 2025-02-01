<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      data-textdirection="{{ app()->getLocale()=="ar" ? 'rtl' : 'ltr' }}"
>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="upgrage-insecure-requests">
  <title>Baladi Express | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('/../assets/admin/fonts/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/../assets/admin/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('/../assets/admin/fonts/SansPro/SansPro.min.css') }}">
</head>
@if (app()->getLocale()=='ar')
<style>
  input.form-control {
      text-align: right;
  }
  p {
      text-align: right;
  }
  </style>
@else
<style>
  input.form-control {
      text-align: left;
  }
  p {
      text-align: left;
  }
  </style>
@endif


<body class="hold-transition login-page" style="background-size: cover; background-image: url('{{ asset('/../assets/admin/imgs/doha.webp') }}')">
<div class="login-box">
  <div class="login-logo">
    <a href="">
      <b >{{ __('mycustom.login_first_title') }}
       </b>{{ __('mycustom.login_second_title') }} 
      </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">


      @if(Session::has('error'))
      <div class="alert alert-danger text-right" role="alert">
         {{  Session::get('error') }}
      </div>
      @endif

      {{-- @if(Session::has('success'))
      <div class="alert alert-success text-right" role="alert">
      {{ Session::get('success') }}  
      </div>
   @endif --}}


      <p class="login-box-msg">
        {{ __('mycustom.login') }} 
      </p>

      <form action="{{ route('admin.login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder={{ __('mycustom.username') }} >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('username')
        <p class="text-danger">   {{ $message }}</p>
          
        @enderror

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder={{ __('mycustom.password') }} >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        @error('password')
        <p class="text-danger">   {{ $message }}</p>
          
        @enderror
        <div class="row">
        
            <div class="col-12">
              <button type="submit" class="btn  btn-block btn-flat" style="background-color: #EF4C2B;color:white">
                {{ __('mycustom.login') }}  
              </button>
            </div>
            <!-- /.col -->
          </div>
      </form>


    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('/../assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/../assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
