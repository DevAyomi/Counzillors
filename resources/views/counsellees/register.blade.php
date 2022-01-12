<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('auth/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('auth/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">

    <title>Registeration</title>
  </head>
  <body>
  

  
  <div class="container mt-5">
  	<div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="{{ asset('auth/images/undraw_file_sync_ot38.svg') }}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In as a <strong>Counsellee</strong></h3>
              <p class="mb-4">Counzilors... a web app that connect counsellors and counsilees</p>
            </div>

           @if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

            <form action="{{route('counsellee.register')}}" method="post">
            	@csrf
              <div class="form-group first">   
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                <input type="text" name="email" class="form-control mt-2" id="useremail" placeholder="User Email">
              </div>
              <div class="form-group last mb-4">
               
                <input type="password" name="password" placeholder="Password" class="form-control mt-2" id="password">
                 <input type="password" placeholder="Confirm Password" name="password_confirmation" class="form-control mt-2" id="confirm-password">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption"><a href="{{route('counsellor.register-view') }}">Register as counsellor</a></span>
                 
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" value="Register" class="btn text-white btn-block btn-primary">

              <span class="d-block text-left my-4 text-muted"><a href="{{ route('counsellee.login-view') }}">Already have an account</a></span>
              
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  	</div>
  
    <script src="{{ asset('auth/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('auth/js/popper.min.js') }}"></script>
    <script src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth/js/main.js') }}"></script>
  </body>
</html>