@extends('layouts.main')

@section('title')
  Pengguna &mdash; {{$setting->site_title}}
@endsection

@section('favicon')
  <!-- ICONS -->  
  <link rel="icon" type="image" href="{{ asset('storage/'.$setting->site_favicon) }}">
@endsection

@section('content')

    <section class="section">
      <div class="section-header">
        <h1>Pengguna</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ asset(route('dashboard', false)) }}">Dashboard</a></div>
          <div class="breadcrumb-item">Pengguna</div>
        </div>
      </div>

      <div class="section-body">        
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              {{-- <div class="card-header">
                <h4>Daftar user</h4>
              </div> --}}
              {{-- <div class="card-footer text-right ">
                <a href="{{ asset(route('user.create', [], false)) }}" class="btn btn-icon icon-left btn-primary"><i class="fa fa-user-plus"></i> Tambah Pengguna</a>
              </div> --}}
                 
              <div class="card-body">
                {{-- <div class="section-title mt-0">Light</div> --}}
                <table class="table table-hover" id="usertable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Email</th>                      
                      <th scope="col">Nomor Telp/HP</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Status</th>
                      <th scope="col">Foto</th>
                      <th scope="col" class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($data_user as $user)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phone }}</td>
                      <td>{{ $user->nip }}</td>
                      <td>{{ ($user->is_active)?'Aktif':'Tidak Aktif' }}</td>
                      <td>
                        <figure class="avatar mr-2 avatar-sm">
                          <img src="{{asset('storage/'.$user->photo)}}" alt="...">
                        </figure>
                      </td>
                      <td class="col-md-2 text-center">  

                          <form action="{{ route('user.destroy', $user->username)}}" method="post">
                          @method('DELETE')
                          @csrf
                            <a href="{{ asset(route('user.show', $user->username)) }}" class="btn btn-icon btn-sm btn-primary" title="lihat"><i class="fa fa-eye"></i></a>

                            <a href="{{ asset(route('user.edit', $user->username)) }}" class="btn btn-icon btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i></a>
                            
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

        $('#usertable').DataTable();         

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
