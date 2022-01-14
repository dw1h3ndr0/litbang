@extends('layouts.main')
@section('content')

    <section class="section">
      <div class="section-header">
        <h1>Riset</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ asset(route('dashboard', false)) }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ asset(route('riset.index', false)) }}">Riset</a></div>
          <div class="breadcrumb-item">Edit Riset</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Riset</h4>
              </div>
              
              <div class="card-body">
                
                <form action="{{ asset(route('riset.update', $riset->slug)) }}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Judul Riset <i class="text-danger">*</i></label>
                  <div class="col-sm-9">
                    <input name="judul" type="text" class="form-control {{$errors->has('judul') ? 'is-invalid' : ''}} " value="{{ $riset->judul }}">
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
                      @for ($i =2016; $i <= $year; $i++)
                        @if($riset->tahun == $i)
                          <option value="{{ $i }}" selected>{{ $i }}</option>
                        @else
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                      @endfor
                    </select>
                  </div>
                  @if ($errors->has('tahun'))
                    <div class="invalid-feedback">
                      {{$errors->first('tahun')}}
                    </div>
                  @endif
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pelaksana Kegiatan <i class="text-danger">*</i></label>
                  <div class="col-sm-9">
                    <input name="pelaksana" type="text" class="form-control {{$errors->has('pelaksana') ? 'is-invalid' : ''}}" value="{{ $riset->pelaksana }}">
                    @if ($errors->has('pelaksana'))
                      <div class="invalid-feedback">
                        {{$errors->first('pelaksana')}}
                      </div>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nomor Induk Kependudukan (NIK) </label>
                  <div class="col-sm-9">
                    <input name="nik" type="text" class="form-control {{$errors->has('nik') ? 'is-invalid' : ''}}" value="{{ $riset->nik }}">
                    @if ($errors->has('nik'))
                      <div class="invalid-feedback">
                        {{$errors->first('nik')}}
                      </div>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nomor Surat Izin</label>
                  <div class="col-sm-5">
                    <input name="no_surat_izin" type="text" class="form-control {{$errors->has('no_surat_izin') ? 'is-invalid' : ''}}" value="{{ $riset->no_surat_izin }}">
                    @if ($errors->has('no_surat_izin'))
                      <div class="invalid-feedback">
                        {{$errors->first('no_surat_izin')}}
                      </div>
                    @endif
                  </div>

                  <label class="col-sm-2 col-form-label">Tanggal Surat Izin</label>
                  <div class="col-sm-2">
                    <input name="tgl_surat_izin" type="text" class="form-control datepicker {{$errors->has('tgl_surat_izin') ? 'is-invalid' : ''}}" value="{{ $riset->tgl_surat_izin }}">
                    @if ($errors->has('tgl_surat_izin'))
                      <div class="invalid-feedback">
                        {{$errors->first('tgl_surat_izin')}}
                      </div>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kartu Tanda Penduduk (KTP)</label>
                  <div class="col-sm-9">
                    <input type="file" name="ktp" class="dropify {{$errors->has('ktp') ? 'is-invalid' : ''}} " id="dropify-ktp" 
                    @if( is_null($riset->ktp))
                    
                    @else 
                      data-default-file="{{asset('storage/'.$riset->ktp)}}" 
                    @endif >
                    <small class="form-text text-mute">Format file yang dibolehkan adalah <b>pdf, jpg, png</b> dengan ukuran ukuran maksimal 1MB</small>
                    @if ($errors->has('ktp'))
                      {{-- <div class="invalid-feedback"> --}}
                          <small class="form-text text-mute" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;"> {{$errors->first('ktp')}} </small>
                        {{-- </div> --}}
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Proposal</label>
                  <div class="col-sm-9">
                    <input type="file" name="proposal" class="dropify {{$errors->has('proposal') ? 'is-invalid' : ''}} " id="dropify-event" 
                    @if( is_null($riset->proposal))
                    
                    @else 
                      data-default-file="{{asset('storage/'.$riset->proposal)}}" 
                    @endif >
                    <small class="form-text text-mute">Format file yang dibolehkan adalah <b>pdf</b> dengan ukuran ukuran maksimal 10MB</small>
                    @if ($errors->has('proposal'))
                      {{-- <div class="invalid-feedback"> --}}
                          <small class="form-text text-mute" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;"> {{$errors->first('proposal')}} </small>
                        {{-- </div> --}}
                    @endif
                  </div>
                </div>

                <input type="hidden" id="idRiset" value="{{ $riset->id }}" >
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label">Abstrak</label>
                  <div class="col-sm-9">
                    <textarea class="summernote form-control {{$errors->has('abstrak') ? 'is-invalid' : ''}}" name="abstrak" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">{{ $riset->abstrak }}</textarea>
                    @if ($errors->has('abstrak'))
                      <div class="invalid-feedback">
                        {{$errors->first('abstrak')}}
                      </div>
                    @endif
                  </div>
                </div>
                
              </div>
              <div class="card-footer text-right ">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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

      var drKtp = $('#dropify-ktp').dropify();
      drKtp.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drKtp.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
      });

      var drEvent = $('#dropify-event').dropify();
      drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      var idRiset = $('#idRiset').val();
      // console.log(idRiset);
      drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');

        var url = base_url+'riset/'+idRiset+'/removeFile';          
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