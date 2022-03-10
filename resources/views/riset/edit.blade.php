@extends('layouts.main')

@section('title')
  Riset &mdash; {{$setting->site_title}}
@endsection

@section('favicon')
  <!-- ICONS -->  
  <link rel="icon" type="image" href="{{ asset('storage/'.$setting->site_favicon) }}">
@endsection

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
                  <label class="col-sm-3 col-form-label">Tahun Data <i class="text-danger">*</i></label>
                  <div class="col-sm-9">
                    <select name="tahun_data" class="form-control select2 {{$errors->has('tahun_data') ? 'is-invalid' : ''}}">                    
                    {{ $year = date('Y') }}
                    <option value="">--pilih tahun data--</option>
                    @for ($i =2016; $i <= $year; $i++)
                      @if($riset->tahun_data == $i)
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                      @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                    </select>
                    @if ($errors->has('tahun_data'))
                      <div class="invalid-feedback">
                        {{$errors->first('tahun_data')}}
                      </div>
                    @endif
                  </div>                    
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tahun Pelaksanaan <i class="text-danger">*</i></label>
                  <div class="col-sm-4">
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

                  <label class="col-sm-2 col-form-label text-right">Waktu Pelaksanaan <i class="text-danger">*</i></label>
                  <div class="col-sm-3">
                    <input name="tgl_pelaksanaan" class="form-control {{$errors->has('tgl_pelaksanaan') ? 'is-invalid' : ''}}" type="text" value="{{ $riset->tgl_mulai }} - {{ $riset->tgl_selesai }}" />
                    @if ($errors->has('tgl_pelaksanaan'))
                      <div class="invalid-feedback">
                        {{$errors->first('tgl_pelaksanaan')}}
                      </div>
                    @endif                      
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sumber Pendanaan <i class="text-danger">*</i></label>
                  <div class="col-sm-9">
                    <select name="sumber_dana" class="form-control select2 {{$errors->has('sumber_dana') ? 'is-invalid' : ''}}"> 
                      <option value="">--pilih sumber dana--</option>
                      <option value="Dalam Negeri" {{ $riset->sumber_dana == 'Dalam Negeri' ? 'selected' : ''}}>Dalam Negeri</option>
                      <option value="Luar Negeri" {{ $riset->sumber_dana == 'Luar Negeri' ? 'selected' : ''}}>Luar Negeri</option>
                    </select>
                    @if ($errors->has('sumber_dana'))
                      <div class="invalid-feedback">
                        {{$errors->first('sumber_dana')}}
                      </div>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kategori <i class="text-danger">*</i></label>
                  <div class="col-sm-9">
                    <select class="js-example-basic-multiple" name="kategori[]" multiple="multiple">
                      @foreach($data_kategori as $kategori)
                        {{$key = 0;}}
                        @foreach($kategoris as $kat)                         
                          @if($kategori->id == $kat)
                            {{$key = 1;}}                            
                          @endif                       
                        @endforeach
                        @if($key == 1)
                          <option value="{{ $kategori->id }}" selected>{{ $kategori->name }}</option> 
                        @else
                          <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                        @endif
                      @endforeach
                    </select>

                    {{-- <select name="kategori" class="form-control select2 {{$errors->has('kategori') ? 'is-invalid' : ''}}">                 
                    @foreach($data_kategori as $kategori)    
                      @if($riset->kategori_id == $kategori->id)
                        <option value="{{ $kategori->id }}" selected>{{ $kategori->name }}</option>
                      @else                  
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                      @endif
                    @endforeach                      
                    </select> --}}
                    @if ($errors->has('kategori'))
                      <div class="invalid-feedback">
                        {{$errors->first('kategori')}}
                      </div>
                    @endif
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Penyelenggara Kegiatan <i class="text-danger">*</i></label>
                  <div class="col-sm-9">
                    <select name="penyelenggara" class="form-control select2 {{$errors->has('penyelenggara') ? 'is-invalid' : ''}}"> 
                      <option value="">--pilih penyelenggara kegiatan--</option>
                      <option value="Individu" {{$riset->penyelenggara == 'Individu' ? 'selected' : ''}}>Individu</option>
                      <option value="Kementerian/Lembaga" {{$riset->penyelenggara == 'Kementerian/Lembaga' ? 'selected' : ''}}>Kementerian/Lembaga</option>
                      <option value="Perguruan Tinggi" {{$riset->penyelenggara == 'Perguruan Tinggi' ? 'selected' : ''}}>Perguruan Tinggi</option>
                      <option value="Organisasi Masyarakat" {{$riset->penyelenggara == 'Organisasi Masyarakat' ? 'selected' : ''}}>Organisasi Masyarakat</option>
                      <option value="Badan Usaha" {{$riset->penyelenggara == 'Badan Usaha' ? 'selected' : ''}}>Badan Usaha</option>
                    </select>
                    @if ($errors->has('penyelenggara'))
                      <div class="invalid-feedback">
                        {{$errors->first('penyelenggara')}}
                      </div>
                    @endif
                  </div>
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
                  <label class="col-sm-3 col-form-label">Penanggung Jawab Kegiatan <i class="text-danger">*</i></label>
                  <div class="col-sm-9">
                    <input name="penanggungjawab" type="text" class="form-control {{$errors->has('penanggungjawab') ? 'is-invalid' : ''}}" value="{{ $riset->penanggungjawab }}">
                    @if ($errors->has('penanggungjawab'))
                      <div class="invalid-feedback">
                        {{$errors->first('penanggungjawab')}}
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
                  <label class="col-sm-3 col-form-label">Nomor Kontak <i class="text-danger">*</i></label>
                  <div class="col-sm-9">
                    <input name="kontak" type="text" class="form-control {{$errors->has('kontak') ? 'is-invalid' : ''}}" value="{{ $riset->kontak }}">
                    @if ($errors->has('kontak'))
                      <div class="invalid-feedback">
                        {{$errors->first('kontak')}}
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
                      {{-- @if(Str::before($riset->ktp,'/') == 'ktp') --}}
                        data-default-file="{{asset('storage/'.$riset->ktp)}}"
                      {{-- @else 
                        data-default-file="{{asset($riset->ktp)}}"
                      @endif --}}
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

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Hasil Penelitian</label>
                  <div class="col-sm-9">
                    <input type="file" name="hasil_penelitian" class="{{$errors->has('hasil_penelitian') ? 'is-invalid' : ''}}" id="dropify-hasil" 
                    @if( is_null($riset->hasil_penelitian))
                    
                    @else 
                      data-default-file="{{asset('storage/'.$riset->hasil_penelitian)}}" 
                    @endif >
                    <small class="form-text text-mute">Format file yang dibolehkan adalah <b>pdf</b> dengan ukuran ukuran maksimal 10MB</small>
                    @if ($errors->has('hasil_penelitian'))
                      {{-- <div class="invalid-feedback"> --}}
                          <small class="form-text text-mute" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;"> {{$errors->first('hasil_penelitian')}} </small>
                        {{-- </div> --}}
                    @endif
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label">Resume</label>
                  <div class="col-sm-12 col-md-9">
                    <textarea class=" summernote form-control {{$errors->has('resume') ? 'is-invalid' : ''}}" name="resume" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">{{ $riset->resume }}</textarea>
                    @if ($errors->has('resume'))
                      <div class="invalid-feedback">
                        {{$errors->first('resume')}}
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

      var idRiset = $('#idRiset').val();
      // console.log(idRiset);

      var drKtp = $('#dropify-ktp').dropify();
      drKtp.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drKtp.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
        var url = base_url+'riset/'+idRiset+'/removeFile/ktp';          
        window.location = url; 
      });

      var drEvent = $('#dropify-event').dropify();
      drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });
      drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
        var url = base_url+'riset/'+idRiset+'/removeFile/proposal';          
        window.location = url;          
      });

      var drHasil = $('#dropify-hasil').dropify();
      drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
      });

      drHasil.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
        var url = base_url+'riset/'+idRiset+'/removeFile/penelitian';          
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

      $(function() {
        $('input[name="tgl_pelaksanaan"]').daterangepicker({
          opens: 'left',
          locale: {format: 'YYYY-MM-DD'},
        }, function(start, end, label) {
          console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
      });

      $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
      });
      
    });
    
</script>

@endpush