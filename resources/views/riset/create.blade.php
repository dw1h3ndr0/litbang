@extends('layouts.main')
@section('content')

    <section class="section">
      <div class="section-header">
        <h1>Riset</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ asset(route('dashboard', false)) }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ asset(route('riset.index', false)) }}">Riset</a></div>
          <div class="breadcrumb-item">Tambah Riset</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Tambah Riset</h4>
              </div>
              
              <form action="{{ asset(route('riset.store', false)) }}" method="POST" enctype="multipart/form-data">
              @csrf
              
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Judul Riset <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <input name="judul" type="text" class="form-control {{$errors->has('judul') ? 'is-invalid' : ''}} " value="{{ old('judul') }}">
                      @if ($errors->has('judul'))
                      <div class="invalid-feedback">
                        {{$errors->first('judul')}}
                      </div>
                      @endif
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tahun <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <select name="tahun" class="form-control select2 {{$errors->has('tahun') ? 'is-invalid' : ''}}">                    
                      {{ $year = date('Y') }}
                      <option value="">--pilih tahun--</option>
                      @for ($i =2016; $i <= $year; $i++)
                        @if(old('tahun') == $i)
                          <option value="{{ $i }}" selected>{{ $i }}</option>
                        @else
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                      @endfor
                      </select>
                      @if ($errors->has('tahun'))
                        <div class="invalid-feedback">
                          {{$errors->first('tahun')}}
                        </div>
                      @endif
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pelaksana Kegiatan <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                      <input name="pelaksana" type="text" class="form-control {{$errors->has('pelaksana') ? 'is-invalid' : ''}}" value="{{ old('pelaksana') }}">
                      @if ($errors->has('pelaksana'))
                        <div class="invalid-feedback">
                          {{$errors->first('pelaksana')}}
                        </div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Surat Izin</label>
                    <div class="col-sm-9">
                      <input name="no_surat_izin" type="text" class="form-control {{$errors->has('no_surat_izin') ? 'is-invalid' : ''}}" value="{{ old('no_surat_izin')}}">
                      @if ($errors->has('no_surat_izin'))
                        <div class="invalid-feedback">
                          {{$errors->first('no_surat_izin')}}
                        </div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kuesioner</label>
                    <div class="col-sm-9">
                      <input type="file" name="kuesioner" class="{{$errors->has('kuesioner') ? 'is-invalid' : ''}}" id="dropify-event" >
                      <small class="form-text text-mute">Format file yang dibolehkan adalah <b>pdf</b> dengan ukuran ukuran maksimal 10MB</small>
                      @if ($errors->has('kuesioner'))
                        {{-- <div class="invalid-feedback"> --}}
                            <small class="form-text text-mute" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;"> {{$errors->first('kuesioner')}} </small>
                          {{-- </div> --}}
                      @endif
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <label class="col-sm-3 col-form-label">Kesimpulan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control {{$errors->has('kesimpulan') ? 'is-invalid' : ''}}" name="kesimpulan" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">{{ old('kesimpulan')}}</textarea>
                      @if ($errors->has('kesimpulan'))
                        <div class="invalid-feedback">
                          {{$errors->first('kesimpulan')}}
                        </div>
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

    $(function() {
      $('.dropify').dropify();

      var drEvent = $('#dropify-event').dropify();
      drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
      });
    });
    
</script>

@endpush