@extends('layouts.main')
@section('content')

    <section class="section">
      <div class="section-header">
        <h1>Riset</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ asset(route('dashboard', false)) }}">Dashboard</a></div>
          <div class="breadcrumb-item">Riset</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              {{-- <div class="card-header">
                <h4>Daftar Riset</h4>
              </div> --}}
              {{-- <div class="card-footer text-right ">
                <a href="{{ asset(route('riset.create', [], false)) }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Riset</a>
              </div> --}}
                 
              <div class="card-body">
                {{-- <div class="section-title mt-0">Light</div> --}}


                <table class="table table-hover" id="risettable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Tahun</th>
                      <th scope="col">Judul</th>
                      <th scope="col">Pelaksana Kegiatan</th>
                      <th scope="col">No. Surat Izin</th>
                      <th scope="col" class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($data_riset as $riset)
                    <tr>
                      <td>{{ $loop->index + 1}}</td>
                      <td>{{ $riset->tahun }}</td>
                      <td>{{ $riset->judul }}</td>
                      <td>{{ $riset->pelaksana }}</td>
                      <td>{{ $riset->no_surat_izin}}</td>
                      <td class="text-center"> 
                          
                          <form action="{{ route('riset.destroy', $riset->slug)}}" method="post">
                          @method('DELETE')
                          @csrf
                            <a href="{{ asset(route('riset.show', $riset->slug)) }}" class="btn btn-icon btn-sm btn-primary" title="lihat"><i class="fa fa-eye"></i></a>
                            
                            <a href="{{ asset(route('riset.edit', $riset->slug)) }}" class="btn btn-icon btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                            
                            <button class="btn btn-icon btn-sm btn-danger delete-button" {{-- onclick="myFunction()" --}} style="display:inline;" title="hapus"><i class="fa fa-trash"></i></button>
                          </form>
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
    </section>
      
@endsection

@push('scripts')
<script>

    $(document).ready(function() {
        $('#risettable').DataTable();      
    });  

    // function myFunction() {
      $('.delete-button').click(function(e){
      e.preventDefault();
      Swal.fire({
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
            $(e.target).closest('form').submit() // Post the surrounding form

          }
        }); 
       });
    // }
        

    </script>
@endpush

