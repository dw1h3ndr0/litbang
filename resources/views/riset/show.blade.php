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

              <div class="card card-info">
                <div class="row">                  
                  <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card-body">
                      <strong>Tahun</strong>
                      <p class="text-muted">{{ $riset->tahun }}</p>
                      <hr>
                      <strong>Kategori</strong>
                      <p class="text-muted">{{ $riset->kategori->name }}</p>
                      <hr>
                      <strong>Judul</strong>
                      <p class="text-muted">{{ $riset->judul }}</p>
                      <hr>
                      <strong>Pelaksana</strong>
                      <p class="text-muted">{{ $riset->pelaksana }}</p>
                      <hr>
                      <strong>NIK </strong><button class="btn btn-link" data-toggle="modal" data-target="#contohModal">-detail-</button>
                      <p class="text-muted">{{ is_null($riset->nik) ? '-' : $riset->nik }}</p>
                      <hr>
                      <strong>Nomor Surat Izin</strong>
                      <p class="text-muted">{{ is_null($riset->no_surat_izin) ? '-' : $riset->no_surat_izin }}</p>
                      <hr>   
                      <strong>Tanggal Surat Izin</strong>
                      <p class="text-muted">{{ is_null($riset->tgl_surat_izin) ? '-' : $riset->tgl_surat_izin }}</p>
                      <hr>                                                           
                    </div>
                    <!-- /.card -->
                  </div>
                  <div class="col-md-8">
                    <div class="card">                                  
                      <div class="card-body">
                        <div class="user-item ">
                          <div class="text-center">
                            <iframe src="{{asset('storage/'.$riset->proposal)}}" width="100%" height="500px"></iframe> 
                          </div>
                          <div class="user-details">
                            <div class="user-name text-center"><h5>{{ $riset->judul }}</h5></div>
                            <div class="text-job text-muted text-center"> {{ $riset->pelaksana }} </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                     <div class="card-body">                       
                      <strong>Abstrak</strong>                                            
                        <p class="text-muted">
                          {!!$riset->abstrak !!}                  
                        </p>
                        <hr>
                     </div>
                    
                  </div>
                </div>
              </div>
                            
              <div class="card-footer text-right ">
                <a class="btn btn-primary" href="{{ asset(route('riset.edit', $riset->slug)) }}"><i class="fa fa-edit"></i> edit</a>
              </div>

            </div>            
          </div>          
        </div>
      </div>

    </section>

    <div class="modal fade" id="contohModal" tabindex="-1" role="dialog" arialabelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">KTP</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if(Str::beforeLast($riset->ktp,'.') == 'pdf')
             <iframe src="{{asset('storage/'.$riset->ktp)}}" width="100%" height="100%"></iframe>
            @else
             <image src="{{asset('storage/'.$riset->ktp)}}" width="100%" height="100%">
            @endif
          </div>
        </div>
      </div>
    </div> 
      
      
@endsection

@push('scripts')
<script>

    $(function() {
      $('.dropify').dropify();

      $('.summernote').summernote({
        airMode: true
      });
      // $('.summernote').summernote('disable');



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