@extends('layout.admin')
@push('css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" 
          integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endpush

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1 class="m-0">Data Surat</h1> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Data Surat</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="container">
    <a href="/tambahdatasurat" class="btn btn-success">Tambah +</a>
    {{-- {{ Session::get('halaman_url') }} --}}
    <div class="row g-3 align-items-center mt-2">
        <div class="col-auto">
          <form action="/datasurat" method="GET">
            <input type="search" id="inputPassword6" name="search" placeholder="Cari..." class="form-control" aria-describedby="passwordHelpInline">
          </form>
        </div>
        <div class="col-auto">
          <a href="/exportexcel" class="btn btn-info">Exsport Excel</a>
        </div>
        <div class="col-auto">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
            Import Data
            </button>
        </div> 
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
                <form action="/importexcel" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <input type="file" name="file" required>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
       </div>       
    </div>
    <div class="row">  
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif --}}
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No. Order test</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Surat Dari</th>
                <th scope="col">Instansi</th>
                <th scope="col">Jenis Data</th>
                <th scope="col">PIC</th>
                <th scope="col">Detail</th>
                <th scope="col">Status Permohonan</th>
              </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $index => $row) 
              <tr>
                <th scope="row">{{ $index + $data->firstitem() }}</th>
                <td>{{$row->created_at->format('D M Y') }}</td>
                <td>{{$row->nama}}</td>
                <td>
                    <img src="{{ asset('fotopegawai/'.$row->foto) }}" alt="" style="width: 50px;">
                </td>
                <td>{{$row->kriteriapemohon}}</td>
                <td>0{{$row->notlpn}}</td>

                <td>
                    <a href="tampilkandata/{{ $row->id }}" class="btn btn-info">Edit</a>
                    <a href="#"class="btn btn-danger delete" data-id="{{$row->id}}" data-nama="{{ $row->nama }}">Delete</a>
                  </td>
                <td>

                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
  </div>

  
@endsection

@push('scripts')
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
  integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" 
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" 
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" 
  crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
  crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" 
  integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" 
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
<script>
$('.delete').click( function(){
var pegawaiid = $(this).attr('data-id');
var nama = $(this).attr('data-nama');
        swal({
          title: "Yakin?",
          text: "Kamu akan menghapus data pegawai dengan nama "+nama+" ",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location = "/delete/"+pegawaiid+""
            swal("Data berhasil dihapus", {
              icon: "success",
            });
          } else {
            swal("Data tidak jadi dihapus");
          }
        });
      });
    
</script>
<script>
@if (Session::has('success'))
toastr.success("{{ Session::get('success') }}")
@endif

// toastr.success('Have fun storming the castle!','Miracle Max Says')
</script>
@endpush