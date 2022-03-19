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
        <h1>Pengguna</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ asset(route('dashboard', false)) }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ asset(route('user.index', false)) }}">Pengguna</a></div>
          <div class="breadcrumb-item">Detail Pengguna</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Detail Pengguna</h4>
              </div>

              <div class="card card-info">
                <div class="row">                  
                  <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card">                                  
                      <div class="card-body">
                        <div class="user-item ">
                          <div class="text-center">
                            <img class="img-fluid img-circle" src="{{asset('storage/'.$user->photo)}}" alt="photo">
                          </div>
                          <div class="user-details">
                            <div class="user-name text-center"><h5>{{ $user->name }}</h5></div>
                            <div class="text-job text-muted text-center"> {{ $user->role->display_name }} </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>

                  <div class="col-md-9">
                    <div class="card-body">
                      <strong>Nama</strong>
                      <p class="text-muted">{{ $user->name }}</p>
                      <hr>
                      {{-- <strong>Username</strong>
                      <p class="text-muted">{{ $user->username }}</p>
                      <hr> --}}
                      <strong>Email</strong>
                      <p class="text-muted">{{ $user->email }}</p>
                      <hr>
                      <strong>Wilayah</strong>
                      <p class="text-muted">{{ $user->wilayah->wilayah }}</p>
                      <hr>
                      <strong>Nomor Telepon</strong>
                      <p class="text-muted">{{ is_null($user->phone) ? '-' : $user->phone }}</p>
                      <hr>
                      <strong>Nomor Induk Pegawai (NIP)</strong>
                      <p class="text-muted">{{ is_null($user->nip) ? '-' : $user->nip }}</p>
                      <hr>
                      <strong>Status</strong>
                      <p class="text-muted">{{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
                      <hr>
                        
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right ">
                <a class="btn btn-primary" href="{{ asset(route('user.edit', $user->username)) }}"><i class="fa fa-edit"></i> edit</a>
              </div>
            </div>            
          </div>          
        </div>
      </div>
    </section>
      
@endsection
