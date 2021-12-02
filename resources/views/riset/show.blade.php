@extends('layouts.main')
@section('content')

    <section class="section">
      <div class="section-header">
        <h1>Riset</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ asset(route('dashboard', false)) }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ asset(route('riset.index', false)) }}">Riset</a></div>
          <div class="breadcrumb-item">Detail Riset</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Detail Riset</h4>
              </div>
              
              <div class="card-body">
                                
                <fieldset disabled>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Judul Riset</label>
                  <div class="col-sm-9">
                    <input name="judul" type="text" class="form-control" value="{{$riset->judul}}" >
                  </div>
                </div>

                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tahun</label>
                  <div class="col-sm-9">
                    <select name="tahun" class="form-control select2">                    
                      {{ $year = date('Y') }}
                      <option value="">--pilih tahun--</option>
                      @for ($i =2016; $i <= $year; $i++)
                         <option value="{{ $i }}" {{ ($i === $riset->tahun) ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pelaksana Kegiatan</label>
                  <div class="col-sm-9">
                    <input name="pelaksana" type="text" class="form-control" value="{{ $riset->pelaksana }}"> 
                  </div>                 
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nomor Surat Izin</label>
                  <div class="col-sm-9">
                    <input name="no_surat_izin" type="text" class="form-control" value="{{ $riset->no_surat_izin}}">
                  </div>
                </div>

                <div class="form-group row {{$errors->has('kuesioner') ? 'has-error' : ''}}">
                  <label class="col-sm-3 col-form-label">Kuesioner</label>
                  <div class="col-sm-9">
                    <input type="file" name="kuesioner" class="dropify {{$errors->has('kuesioner') ? 'is-invalid' : ''}} " id="dropify-event" data-default-file="{{asset('files/'.$riset->kuesioner)}}" data-show-remove="false" >
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
                    <textarea class="form-control" name="kesimpulan" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">{{ $riset->kesimpulan}}</textarea>
                  </div>
                </div>
                
              </div>
              <div class="card-footer text-right ">
                <a class="btn btn-primary" href="{{ asset(route('riset.edit', $riset->slug)) }}"><i class="fa fa-edit"></i> edit</a>
              </div>

            </fieldset>
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