@extends('layouts.main')

@section('title')
  Pengguna &mdash; {{$setting->site_title}}
@endsection

@section('favicon')
  <!-- ICONS -->  
  <link rel="icon" type="image" href="{{ asset('storage/'.$setting->site_favicon) }}">
@endsection

@section('content')

    <section class="section">
      <div class="section-header">
        <h1>Ganti Password</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ asset(route('dashboard', false)) }}">Dashboard</a></div>
          <div class="breadcrumb-item">Ganti Password</div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">

            <div class="card card-primary">
              <div class="card-header"><h4>Ganti Password</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ asset(route('change.password', $user->username)) }}">
                {{ method_field('PUT') }}
                @csrf
                    <div class="form-group">
                        <label for="password">Current Password</label>        
                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password"  tabindex="1">
                        @if ($errors->has('current_password'))
                            <span class="text-danger">{{$errors->first('current_password')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password"  tabindex="2">
                        @if ($errors->has('new_password'))
                            <span class="text-danger">{{$errors->first('new_password')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">New Confirm Password</label>      
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password"  tabindex="3">
                        @if ($errors->has('new_confirm_password'))
                            <span class="text-danger">{{$errors->first('new_confirm_password')}}</span>
                        @endif
                    </div>  

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Ganti Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection