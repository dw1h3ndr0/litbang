<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $page }} &mdash; {{ $setting->site_title }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('assets/node_modules/selectric/public/selectric.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">

  <!-- ICONS -->
  <link rel="icon" type="image" href="{{ asset('storage/'.$setting->site_favicon) }}">
  
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form action="{{ asset(route('register', false)) }}" method="POST">
                @csrf
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror " name="name" required value="{{ old('name') }}" autofocus>
                    @error('name') 
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required value="{{ old('username') }}" >
                    @error('username') 
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required value="{{ old('email') }}">
                    @error('name') 
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" data-indicator="pwindicator" name="password" required >
                      <!-- <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div> -->
                      @error('password') 
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="password_confirmation" class="d-block">Konfirmasi Password</label>
                      <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                  </div>
                  
                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>
 -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                  <small class="d-block text-center">Sudah registrasi? <a href="{{ asset(route('login', [], false)) }}">Login</a></small>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; 2021 <div class="bullet"></div> <a href="https://gorontalou.bps.go.id/">BPS Provinsi Gorontalo</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset('assets/js/stisla.js')}}"></script>

  <!-- JS Libraies -->
  <script src="{{asset('node_modules/jquery-pwstrength/jquery.pwstrength.min.js')}}"></script>
  <script src="{{asset('node_modules/selectric/public/jquery.selectric.min.js')}}"></script>

  <!-- Template JS File -->
  <script src="{{asset('assets/js/scripts.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('assets/js/page/auth-register.js')}}"></script>
</body>
</html>
