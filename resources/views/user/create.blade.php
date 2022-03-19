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
          <div class="breadcrumb-item">Tambah Pengguna</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Tambah Pengguna</h4>
              </div>
              
              <form action="{{ asset(route('user.store', false)) }}" method="POST" enctype="multipart/form-data">                    
              @csrf

                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Foto</label>
                    <div class="col-sm-3">
                      <input name="photo" type="file" class=" {{$errors->has('photo') ? 'is-invalid' : ''}} " id="dropify-event" data-default-file="{{asset('storage/profil/'.$avatar)}}" data-show-remove="false" >
                      <small class="form-text text-mute">Format foto yang dibolehkan adalah <b>jpg, png, dan bmp</b> dengan ukuran minimal 200px x 200px dan rasio 1:1.</small>
                      @if ($errors->has('photo'))
                        {{-- <div class="invalid-feedback"> --}}
                          <small class="form-text text-mute" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;"> {{$errors->first('photo')}} </small>
                        {{-- </div> --}}
                      @endif
                    </div>
                  </div>
                  <input name="avatar" type="hidden" class="form-control" value="{{ $avatar }}" >
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <input name="name" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" value="{{ old('name') }}">
                      @if ($errors->has('name'))
                        <div class="invalid-feedback">
                          {{$errors->first('name')}}

                          {{$errors->first('photo')}}
                        </div>
                      @endif
                    </div>
                  </div>
                  {{-- <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Username <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <input name="username" type="text" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{ old('username') }}">
                      @if ($errors->has('username'))
                        <div class="invalid-feedback">
                          {{$errors->first('username')}}
                        </div>
                      @endif
                    </div>
                  </div>  --}}                 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <input name="email" type="email" required class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{ old('email') }}">
                      @if ($errors->has('email'))
                        <div class="invalid-feedback">
                          {{$errors->first('email')}}
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Peran Pengguna <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <select name="role" class="form-control select2 {{$errors->has('role') ? 'is-invalid' : ''}}">                 
                      <option value="">--pilih peran pengguna--</option>
                      @foreach($data_role as $role)    
                        @if(old('role') == $role->id)
                          <option value="{{ $role->id }}" selected>{{ $role->display_name }}</option>
                        @else                  
                          <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                        @endif
                      @endforeach                      
                      </select>
                      @if ($errors->has('role'))
                        <div class="invalid-feedback">
                          {{$errors->first('role')}}
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Wilayah <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <select name="wilayah" class="form-control select2 {{$errors->has('wilayah') ? 'is-invalid' : ''}}">                 
                      <option value="">--pilih wilayah--</option>
                      @foreach($data_wilayah as $wilayah)    
                        @if(old('wilayah') == $wilayah->id)
                          <option value="{{ $wilayah->id }}" selected>[{{$wilayah->kode}}] {{ $wilayah->wilayah }}</option>
                        @else                  
                          <option value="{{ $wilayah->id }}">[{{$wilayah->kode}}] {{ $wilayah->wilayah }}</option>
                        @endif
                      @endforeach                      
                      </select>
                      @if ($errors->has('wilayah'))
                        <div class="invalid-feedback">
                          {{$errors->first('wilayah')}}
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label ">Nomor Telp/HP</label>
                    <div class="col-sm-9">
                      <input name="phone" type="text" class="form-control phone-format {{$errors->has('phone') ? 'is-invalid' : ''}}" value="{{ old('phone') }}">
                      @if ($errors->has('phone'))
                        <div class="invalid-feedback">
                          {{$errors->first('phone')}}
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Induk Pegawai (NIP)</label>
                    <div class="col-sm-9">
                      <input name="nip" type="text" class="form-control nip-format {{$errors->has('nip') ? 'is-invalid' : ''}}" value="{{ old('nip') }}">
                      @if ($errors->has('nip'))
                        <div class="invalid-feedback">
                          {{$errors->first('nip')}}
                        </div>
                      @endif
                    </div>
                  </div>
                                    
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <input name="password" type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" value="{{ old('password') }}">
                      @if ($errors->has('password'))
                        <div class="invalid-feedback">
                          {{$errors->first('password')}}
                        </div>
                      @endif
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Konfirmasi Password <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <input name="password_confirmation" type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" value="{{ old('password_confirmation') }}">
                      @if ($errors->has('password_confirmation'))
                        <div class="invalid-feedback">
                          {{$errors->first('password_confirmation')}}
                        </div>
                      @endif
                    </div>
                  </div>                   
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                </div>
              </form>

            </div>
            
          </div>          
        </div>
      </div>
    </section>
      
@endsection

@push('scripts')
<script>

    $(function() {
      $('.dropify').dropify();

      var drEvent = $('#dropify-event').dropify();
      drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
      });

      new Cleave('.phone-format', {
        // delimiter: ' ',
        // numeral: true;
        blocks: [4, 3, 5],
      });

      new Cleave('.nip-format', {
        // delimiter: ' ',
        // numeral: true,
        blocks: [8, 6, 1, 3],
      });
      
    });
    
</script>

@endpush