@extends('layouts.main')

@section('title')
  Pengaturan &mdash; {{$setting->site_title}}
@endsection

@section('favicon')
  <!-- ICONS -->  
  <link rel="icon" type="image" href="{{ asset('storage/'.$setting->site_favicon) }}">
@endsection

@section('content')

    <section class="section">
      <div class="section-header">
        <h1>Pengaturan</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ asset(route('dashboard', false)) }}">Dashboard</a></div>
          <div class="breadcrumb-item">Pengaturan</div>
        </div>
      </div>

      <div class="section-body">

        <form action="{{ asset(route('setting.store', false)) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h2 class="section-title">Frontend</h2>
        <p class="section-lead">
          Pengaturan frontend
        </p>      
        <div class="row">              
          <div class="col-12 col-md-12 col-lg-6">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Infografis</h4>
              </div>              
              <div class="card-body">                  
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="file" name="infografis" class="dropify {{$errors->has('infografis') ? 'is-invalid' : ''}}" id="dropify-infografis"
                    @if( is_null($setting->infografis))
                  
                    @else 
                      data-default-file="{{asset('storage/'.$setting->infografis)}}" 
                    @endif >
                    <small class="form-text text-mute">Format file yang dibolehkan adalah <b>jpg, jpeg, png, bmp</b> dengan ukuran ukuran maksimal 10MB</small>
                    @if ($errors->has('infografis'))
                      {{-- <div class="invalid-feedback"> --}}
                          <small class="form-text text-mute" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;"> {{$errors->first('infografis')}} </small>
                        {{-- </div> --}}
                    @endif
                  </div>
                </div> 
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-6">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Banner</h4>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="file" name="banner" class="dropify {{$errors->has('banner') ? 'is-invalid' : ''}}" id="dropify-banner"
                    @if( is_null($setting->banner))
                      
                    @else 
                      data-default-file="{{asset('storage/'.$setting->banner)}}" 
                    @endif >
                    <small class="form-text text-mute">Format file yang dibolehkan adalah <b>jpg, jpeg, png, bmp</b> dengan ukuran ukuran maksimal 10MB</small>
                    @if ($errors->has('banner'))
                      {{-- <div class="invalid-feedback"> --}}
                          <small class="form-text text-mute" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;"> {{$errors->first('banner')}} </small>
                        {{-- </div> --}}
                    @endif
                  </div>
                </div>                               
              </div>
            </div>
          </div>
        </div>
        <div class="row">          
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Deskripsi</h4>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-sm-12 col-md-12">
                    <textarea class=" summernote form-control {{$errors->has('site_description') ? 'is-invalid' : ''}}" name="site_description">{{ $setting->site_description }}</textarea>
                    @if ($errors->has('site_description'))
                      <div class="invalid-feedback">
                        {{$errors->first('site_description')}}
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>          
        </div>

        <h2 class="section-title">Backend</h2>
        <p class="section-lead">
          Pengaturan Backend
        </p>  

        <div class="row">              
          <div class="col-12 col-md-12 col-lg-7">
            <div class="card card-primary">
              {{-- 
              <div class="card-header">
                <h4>Kategori</h4>
              </div>
              <div class="card-body"> 
                <div class="form-group row">
                  <div class="col-sm-12"> 

                  <div class="card-footer text-right ">
                    <a href="{{ asset(route('kategori.store', [], false)) }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Riset</a>
                  </div>

                    <div class="table-responsive">
                      <table class="table table-striped table-md">
                        <tbody>
                        <tr>
                          <th>#</th>
                          <th>Kategori</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                        @foreach($data_kategori as $kategori)
                          <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>{{ $kategori->name }}</td>
                          <td>{{ $kategori->description }}</td>
                          <td class="text-center">
                            <a href="{{ asset(route('kategori.update', $kategori->id)) }}" class="btn btn-icon btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                            
                            <button class="btn btn-icon btn-sm btn-danger delete-button" style="display:inline;" title="hapus"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>   
                        @endforeach
                        
                        </tbody>
                      </table>
                    </div>
                  </div>                
                </div>
              </div> --}}

              <div class="card-header">
                <h4>General Settings</h4>
              </div>
              <div class="card-body">                
                <div class="form-group row align-items-center">
                  <label for="site-title" class="form-control-label col-sm-3 text-md-right">Site Title</label>
                  <div class="col-sm-6 col-md-8">
                    <input type="text" name="site_title" class="form-control {{$errors->has('site_title') ? 'is-invalid' : ''}}" id="site-title" value="{{$setting->site_title}}">
                    @if ($errors->has('site_title'))
                      <div class="invalid-feedback">
                        {{$errors->first('site_title')}}
                      </div>
                    @endif
                  </div>
                </div>
                <div class="form-group row align-items-center">
                  <label for="site-tagline" class="form-control-label col-sm-3 text-md-right {{$errors->has('site_tagline') ? 'is-invalid' : ''}}">Site Tagline</label>
                  <div class="col-sm-6 col-md-8">
                    <textarea class="form-control" name="site_tagline" id="site-tagline" style="height: 90px;">{{$setting->site_tagline}}</textarea>
                    @if ($errors->has('site_tagline'))
                      <div class="invalid-feedback">
                        {{$errors->first('site_tagline')}}
                      </div>
                    @endif
                  </div>
                </div>
                <div class="form-group row align-items-center">
                  <label class="form-control-label col-sm-3 text-md-right">Site Logo</label>
                  <div class="col-sm-6 col-md-8">
                    <div class="custom-file">
                      <input type="file" name="site_logo" class="dropify" id="site-logo"
                      @if( is_null($setting->site_logo))
                    
                      @else 
                        data-default-file="{{asset('storage/'.$setting->site_logo)}}" 
                      @endif >
                    </div>
                    <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                  </div>
                </div>
                <div class="form-group row align-items-center">
                  <label class="form-control-label col-sm-3 text-md-right">Favicon</label>
                  <div class="col-sm-6 col-md-8">
                    <div class="custom-file">
                      <input type="file" name="site_favicon" class="dropify" id="site-favicon"
                      @if( is_null($setting->site_favicon))
                    
                      @else 
                        data-default-file="{{asset('storage/'.$setting->site_favicon)}}" 
                      @endif >
                    </div>
                    <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                  </div>
                </div>                
              </div>

            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-5">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login Picture</h4>
              </div>           
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="file" name="login_pict" class="dropify {{$errors->has('login_pict') ? 'is-invalid' : ''}}" id="dropify-login"
                      @if( is_null($setting->login_pict))
                    
                      @else 
                        data-default-file="{{asset('storage/'.$setting->login_pict)}}" 
                      @endif >
                    <small class="form-text text-mute">Format file yang dibolehkan adalah <b>jpg, jpeg, png, bmp</b> dengan ukuran ukuran maksimal 10MB</small>
                    @if ($errors->has('login_pict'))
                      {{-- <div class="invalid-feedback"> --}}
                          <small class="form-text text-mute" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;"> {{$errors->first('login_pict')}} </small>
                        {{-- </div> --}}
                    @endif
                  </div>
                </div>
              </div>              
            </div>
          </div> 
        </div>

        <div class="card-footer text-right ">
          <button class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
        </div>
      </form>

      </div>
    </section>
      
@endsection

@push('scripts')
<script>

  base_url="{{asset('')}}";

    $(function() {
      $('.dropify').dropify();

      var drLogin = $('#dropify-login').dropify();
      drLogin.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drLogin.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
        var url = base_url+'setting/removeFile/login_pict';          
        window.location = url; 
      });

      var drBanner = $('#dropify-banner').dropify();
      drBanner.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drBanner.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
        var url = base_url+'setting/removeFile/banner';          
        window.location = url; 
      });

      var drInfografis = $('#dropify-infografis').dropify();
      drInfografis.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drInfografis.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
        var url = base_url+'setting/removeFile/infografis';          
        window.location = url; 
      });

      var drSiteLogo = $('#site-logo').dropify();
      drSiteLogo.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drSiteLogo.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
        var url = base_url+'setting/removeFile/logo';          
        window.location = url; 
      });

      var drSiteFavicon = $('#site-favicon').dropify();
      drSiteFavicon.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drSiteFavicon.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
        var url = base_url+'setting/removeFile/favicon';          
        window.location = url; 
      });

      $('.datepicker').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
        showDropdowns: true,
        singleDatePicker: true,
        minYear: 2010,
        maxYear: parseInt(moment().format('YYYY'),10),
        autoApply: true,
      });

    });
    
</script>

@endpush