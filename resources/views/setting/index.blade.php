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
          <div class="col-12 col-md-12 col-lg-5">
            <div class="card card-primary">                           

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

          <div class="col-12 col-md-12 col-lg-7">            
            <div class="card card-primary">
              <div class="card-header">
                <h4>Wilayah</h4>
              </div>
              <div class="card-footer text-right float-right">                    
                <a href="#" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#storeWilayahModal"><i class="fa fa-plus"></i> Tambah Wilayah</a>
              </div>
              <div class="card-body"> 
                <div class="form-group row">
                  <div class="col-sm-12"> 

                    <div class="table-responsive">
                      <table class="table table-hover" id="wilayahtabel">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Wilayah</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($data_wilayah as $wilayah)
                          <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>{{ $wilayah->kode }}</td>
                          <td>{{ $wilayah->wilayah }}</td>
                          <td class="text-center">

                            <a href="#" class="btn btn-icon btn-sm btn-warning editWilayah" data-toggle="modal" data-target="#updateWilayahModal" title="edit"><i class="fa fa-edit"></i></a>
                            
                            <a href="#" class="btn btn-icon btn-sm btn-danger deleteWilayah" data-toggle="modal" data-target="#deleteWilayahModal" title="hapus"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>   
                        @endforeach
                        
                        </tbody>
                      </table>
                    </div>
                  </div>                
                </div>
              </div>
            </div>
           
            <div class="card card-primary">
              <div class="card-header">
                <h4>Kategori</h4>
              </div>
              <div class="card-footer text-right float-right">                    
                <a href="#" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#storeKategoriModal"><i class="fa fa-plus"></i> Tambah Kategori</a>
              </div>
              <div class="card-body"> 
                <div class="form-group row">
                  <div class="col-sm-12"> 

                    <div class="table-responsive">
                      <table class="table table-hover" id="kategoritabel">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($data_kategori as $kategori)
                          <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>{{ $kategori->name }}</td>
                          <td>{{ $kategori->description }}</td>
                          <td class="text-center">

                            <a href="#" class="btn btn-icon btn-sm btn-warning edit" data-toggle="modal" data-target="#updateKategoriModal" title="edit"><i class="fa fa-edit"></i></a>
                            
                           {{-- <form action="{{ route('kategori.destroy', $kategori->id)}}" method="post">
                            @method('DELETE') --}}
                            <a href="#" class="btn btn-icon btn-sm btn-danger delete" data-toggle="modal" data-target="#deleteKategoriModal" title="hapus"><i class="fa fa-trash"></i></a>
                            {{-- <button class="btn btn-icon btn-sm btn-danger delete-button" onclick="deleteItem({{$kategori}})" data-id="{{$kategori->id}}" title="hapus"><i class="fa fa-trash"></i></button> --}}

                            {{-- </form> --}}

                          </td>
                        </tr>   
                        @endforeach
                        
                        </tbody>
                      </table>
                    </div>
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

    <div class="modal fade" id="storeWilayahModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="storeWilayahModal">{{ __('Tambah Wilayah') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ asset(route('wilayah.store', false)) }}">
              @csrf

              <div class="form-group row">
                <label for="kode" class="col-md-4 col-form-label text-md-right">{{ __('Kode') }}</label>

                <div class="col-md-6">
                  <input id="kode" type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ old('kode') }}" required autocomplete="kode" autofocus>

                  @error('kode')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="wilayah" class="col-md-4 col-form-label text-md-right">{{ __('Wilayah') }}</label>

                <div class="col-md-6">
                  <textarea class=" form-control  @error('wilayah') is-invalid @enderror" name="wilayah" style="width: 100%; height: 64px; font-size: 100%;" required>{{ old('wilayah')}}</textarea>                  
                  @error('wilayah')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-10 col-form-label text-md-right">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Submit') }}
                    </button>
                </div>
              </div>
            </form>
        </div>
      </div>
      </div>
    </div>

    <div class="modal fade" id="updateWilayahModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateWilayahModal">{{ __('Edit Wilayah') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/wilayah" id="editWilayahForm">
              {{ method_field('PUT') }}
              @csrf

              <div class="form-group row">
                <label for="kode" class="col-md-4 col-form-label text-md-right">{{ __('Kode') }}</label>

                <div class="col-md-6">
                  <input id="kodwil" type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" required>

                  @error('kode')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="wilayah" class="col-md-4 col-form-label text-md-right">{{ __('Wilayah') }}</label>

                <div class="col-md-6">
                  <textarea id="wilayah" class=" form-control  @error('wilayah') is-invalid @enderror" name="wilayah" style="width: 100%; height: 64px; font-size: 100%;" required></textarea>                  
                  @error('wilayah')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-10 col-form-label text-md-right">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Simpan') }}
                    </button>
                </div>
              </div>
            </form>
        </div>
      </div>
      </div>
    </div>

    <div class="modal fade" id="deleteWilayahModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true" hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteWilayahModal">{{ __('Hapus Wilayah') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/wilayah" id="deleteWilayahForm">
              {{ method_field('DELETE') }}
              @csrf              

              <div class="form-group row mb-0">
                <div class="col-md-10 col-form-label text-md-right">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Submit') }}
                    </button>
                </div>
              </div>
            </form>
        </div>
      </div>
      </div>
    </div>

    <div class="modal fade" id="storeKategoriModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="storeKategoriModal">{{ __('Tambah Kategori') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ asset(route('kategori.store', false)) }}">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi') }}</label>

                <div class="col-md-6">
                  <textarea class=" form-control  @error('description') is-invalid @enderror" name="description" style="width: 100%; height: 64px; font-size: 100%;">{{ old('description')}}</textarea>                  
                  @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-10 col-form-label text-md-right">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Submit') }}
                    </button>
                </div>
              </div>
            </form>
        </div>
      </div>
      </div>
    </div>

    <div class="modal fade" id="updateKategoriModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateKategoriModal">{{ __('Edit Kategori') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/kategori" id="editForm">
              {{ method_field('PUT') }}
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>

                <div class="col-md-6">
                  <input id="kategori" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi') }}</label>

                <div class="col-md-6">
                  <textarea id="description" class=" form-control  @error('description') is-invalid @enderror" name="description" style="width: 100%; height: 64px; font-size: 100%;"></textarea>                  
                  @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-10 col-form-label text-md-right">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Simpan') }}
                    </button>
                </div>
              </div>
            </form>
        </div>
      </div>
      </div>
    </div>

    <div class="modal fade" id="deleteKategoriModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true" hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteKategoriModal">{{ __('Hapus Kategori') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/kategori" id="deleteForm">
              {{ method_field('DELETE') }}
              @csrf              

              <div class="form-group row mb-0">
                <div class="col-md-10 col-form-label text-md-right">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Submit') }}
                    </button>
                </div>
              </div>
            </form>
        </div>
      </div>
      </div>
    </div>
      
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

      $(document).ready(function() {
          var table = $('#wilayahtabel').DataTable();   

          //start edit record
          table.on('click', '.editWilayah', function() {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
              $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#kodwil').val(data[1]);
            $('#wilayah').val(data[2]);

            $('#editWilayahForm').attr('action', '/wilayah/'+data[0]);
            $('#updateWilayahModal').modal('show');
          });

          table.on('click', '.deleteWilayah', function() {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
              $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);
            // myFunction(data[0]);
            swal.fire({
              title: 'Apa Anda Yakin?',
              text: "Anda akan menghapus data",
              icon: 'info',
              showCancelButton: true,
              timer: 4000,
              timerProgressBar: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus',
              cancelButtonText: 'Batal'
            }).then((result) => {
            if (result.isConfirmed) {            
              // $(e.target).closest('form').submit()

              $('#deleteWilayahForm').attr('action', '/wilayah/'+data[0]);
              $('#deleteWilayahForm').submit();

            } else{
              console.log('close modal');    
              $("#deleteWilayahModal .close").click();
            }
          });             
        });
      });

      $(document).ready(function() {
          var table = $('#kategoritabel').DataTable();   

          //start edit record
          table.on('click', '.edit', function() {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
              $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#kategori').val(data[1]);
            $('#description').val(data[2]);

            $('#editForm').attr('action', '/kategori/'+data[0]);
            $('#updateKategoriModal').modal('show');
          });

          table.on('click', '.delete', function() {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
              $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);
            // myFunction(data[0]);
            swal.fire({
              title: 'Apa Anda Yakin?',
              text: "Anda akan menghapus data",
              icon: 'info',
              showCancelButton: true,
              timer: 4000,
              timerProgressBar: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus',
              cancelButtonText: 'Batal'
            }).then((result) => {
            if (result.isConfirmed) {            
              // $(e.target).closest('form').submit()

              $('#deleteForm').attr('action', '/kategori/'+data[0]);
              $('#deleteForm').submit();
              
              // var url = '{{ route("kategori.destroy", ":slug") }}';            
              // url = url.replace(':slug', slug);
              // window.location = url;    
              // console.log(url);
              // $.ajax({
              //   url: url,
              //   type:'POST',
                // data:{
                //     '_method': 'DELETE'
                // },
                // success:function(data) {
                //   console.log('berhasil delete');
                //   if (data.status == 1){
                //     swal.fire(
                //         'Deleted!',
                //         'Your file has been deleted.',
                //         "success"
                //     );
                //     $("#tr"+data.slug+"").remove(); // you can add name div to remove
                //   }
                // }
              // });
            } else{
              console.log('close modal');    
              $("#deleteKategoriModal .close").click();
            }
          });             
        });
      });  

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });      
      
    });
    
</script>

@endpush