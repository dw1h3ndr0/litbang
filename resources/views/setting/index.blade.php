@extends('layouts.main')
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
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Pengaturan</h4>
              </div>
              
              <form action="{{ asset(route('setting.store', false)) }}" method="POST" enctype="multipart/form-data">
              @csrf
              
                <div class="card-body">                  

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tentang</label>
                    <div class="col-sm-12 col-md-10">
                      <textarea class=" summernote form-control {{$errors->has('about') ? 'is-invalid' : ''}}" name="about">{{ $setting->about }}</textarea>
                      @if ($errors->has('about'))
                        <div class="invalid-feedback">
                          {{$errors->first('about')}}
                        </div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Infografis</label>
                    <div class="col-sm-10">
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

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Banner</label>
                    <div class="col-sm-10">
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

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Login Picture</label>
                    <div class="col-sm-10">
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
                <div class="card-footer text-right ">
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

  base_url="{{asset('')}}";

    $(function() {
      $('.dropify').dropify();

      var drLogin = $('#dropify-login').dropify();
      drLogin.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drLogin.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
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