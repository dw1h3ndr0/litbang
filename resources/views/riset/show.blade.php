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
                <h4>{{$riset->judul}}</h4>
              </div>

              <div class="card card-info">
                <div class="row">                  
                  <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card-body">
                      <strong>Pelaksanaan</strong>
                      <p class="text-muted">{{ $riset->tahun }} - ({{ date('d-m-Y', strtotime($riset->tgl_mulai)); }} s.d. {{ date('d-m-Y', strtotime($riset->tgl_selesai)); }})</p>
                      <hr>
                      <strong>Tahun Data</strong>
                      <p class="text-muted">{{ $riset->tahun_data }}</p>
                      <hr>
                      <strong>Sumber Pendanaan</strong>
                      <p class="text-muted">{{ $riset->sumber_dana }}</p>
                      <hr>
                      <strong>Kategori</strong>
                      <p class="text-muted">
                        @foreach($data_kategori as $kategori)
                          @foreach($kategoris as $kat)
                            @if($kategori->id == $kat)
                              {{ $kategori->name }};
                              @break 
                            @endif
                          @endforeach
                        @endforeach
                      </p>
                      <hr>
                      <strong>Penyelenggara</strong>
                      <p class="text-muted">{{ $riset->penyelenggara }}</p>
                      <hr>
                      <strong>Pelaksana</strong>
                      <p class="text-muted">{{ $riset->pelaksana }}</p>
                      <hr>                      
                      <strong>Penanggung Jawab</strong>
                      <p class="text-muted">{{ $riset->penanggungjawab }}</p>
                      <hr>
                      <strong>NIK </strong><button class="btn btn-link" data-toggle="modal" data-target="#contohModal">-detail-</button>
                      <p class="text-muted">{{ is_null($riset->nik) ? '-' : $riset->nik }}</p>
                      <hr>                      
                      <strong>Kontak</strong>
                      <p class="text-muted">{{ $riset->kontak }}</p>
                      <hr>
                      <strong>Surat Izin</strong>
                      <p class="text-muted">{{ is_null($riset->no_surat_izin) ? '-' : $riset->no_surat_izin }} tanggal {{ is_null($riset->tgl_surat_izin) ? '-' : $riset->tgl_surat_izin }}</p>
                      <hr>                                                         
                    </div>
                    <!-- /.card -->
                  </div>
                  <div class="col-md-8">
                    <div class="card">                                  
                      <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab5" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab5" data-toggle="tab" href="#home5" role="tab" aria-controls="home" aria-selected="true">
                              <i class="fas fa-file"></i> Abstrak</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab5" data-toggle="tab" href="#profile5" role="tab" aria-controls="profile" aria-selected="false">
                              <i class="fas fa-id-card"></i> Resume</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="myTabContent5">
                          <div class="tab-pane fade active show" id="home5" role="tabpanel" aria-labelledby="home-tab5">
                            <div class="user-item ">
                              <div class="text-center">
                                <iframe src="{{asset('storage/'.$riset->proposal)}}" width="100%" height="500px"></iframe> 
                              </div>
                              <div class="user-details">
                                <div class="user-name text-center"><h5>{{ $riset->judul }}</h5></div>
                                <div class="text-job text-muted text-center"> {{ $riset->pelaksana }} </div>
                              </div>
                            </div>
                            <br>
                            <strong>Abstrak</strong>                                            
                            <p class="text-muted">
                              {!!Str::words($riset->abstrak,120) !!}    
                              <button class="btn btn-link" data-toggle="modal" data-target="#abstrakModal">-baca lagi-</button>              
                            </p>
                            <hr>
                          </div>
                          <div class="tab-pane fade" id="profile5" role="tabpanel" aria-labelledby="profile-tab5">
                            <div class="user-item ">
                              <div class="text-center">
                                <iframe src="{{asset('storage/'.$riset->hasil_penelitian)}}" width="100%" height="500px"></iframe> 
                              </div>
                              <div class="user-details">
                                <div class="user-name text-center"><h5>{{ $riset->judul }}</h5></div>
                                <div class="text-job text-muted text-center"> {{ $riset->pelaksana }} </div>
                              </div>
                            </div>
                            <br>
                            <strong>Resume</strong>                                            
                            <p class="text-muted">
                              {!!Str::words($riset->resume,120) !!}    
                              <button class="btn btn-link" data-toggle="modal" data-target="#resumeModal">-baca lagi-</button>              
                            </p>
                            <hr>
                          </div>
                        </div>                        
                      </div>
                      <!-- /.card-body -->
                    </div>                    
                  </div>
                </div>

                {{-- <div class="row">
                  <div class="col-md-12">
                     <div class="card-body">                       
                      <strong>Resume</strong>                                            
                        <p class="text-muted">
                          {!!$riset->resume !!}                  
                        </p>
                        <hr>
                        <iframe src="{{asset('storage/'.$riset->hasil_penelitian)}}" width="100%" height="500px"></iframe>
                     </div>                    
                  </div>
                </div> --}}

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

    <div class="modal fade" id="abstrakModal" tabindex="-1" role="dialog" arialabelledby="modalLabel">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Abstrak</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="text-muted">
              {!!$riset->abstrak !!}                  
            </p>
          </div>
        </div>
      </div>
    </div>    

    <div class="modal fade" id="resumeModal" tabindex="-1" role="dialog" arialabelledby="modalLabel">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Resume</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="text-muted">
              {!!$riset->resume !!}                  
            </p>
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

    $(function() {
        $('input[name="tgl_pelaksanaan"]').daterangepicker({
          opens: 'left',
          locale: {format: 'YYYY-MM-DD'},
        }, function(start, end, label) {
          console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
      });

</script>

@endpush