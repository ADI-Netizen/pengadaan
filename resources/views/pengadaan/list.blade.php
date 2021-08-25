<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengadaan Barang & Jasa</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminLTE/dist/css/adminlte.min.css')}}">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/toastr/toastr.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    @include('parsial.setting')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      @include('parsial.admUsername')

      <!-- Sidebar Menu -->
      @include('parsial.menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Pengadaan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#pengadaanModal"><i class="fas fa-plus-circle"> Tambah Data</i></button>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" style="text-align:center;">
                  <thead>
                    <tr>
                      <th>Nama Pengadaan</th>
                      <th>Deskripsi</th>
                      <th>Gambar</th>
                      <th>Anggaran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pengadaan as $peng)
                    <tr>
                      <td>{{$peng->nama_pengadaan}}</td>
                      <td><a href="{{$peng->deskripsi}}" target="_blank"><button class="btn btn-outline-primary btn-sm"><i class="fas fa-info-circle"></i> Lihat Detail</button></a></td>
                      <td style="width: 15%">
                        @if($peng->gambar != "-")
                        <img src="{{asset(Storage::url($peng->gambar))}}" style="width: 200px;">
                        <hr>
                        <a href="/hapusGambar/{{$peng->id_pengadaan}}" class="confGambar"><button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus Gambar</button></a>
                        @endif
                        @if($peng->gambar == "-")
                        <form method="post" action="/uploadGambar" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <input type="hidden" name="id_pengadaan" value="{{$peng->id_pengadaan}}">
                          <label for="gambar" class="btn btn-block btn-outline-info btn-flat">Gambar Pengadaan</label>
                          <input type="file" name="gambar" id="gambar" class="form-control" style="display: none;">
                          <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                        @endif
                      </td>
                      <td><span class="tag tag-success">{{number_format($peng->anggaran,0,",",".")}}</span></td>
                      <td>
                        <button type="button" class="btn btn-outline-secondary btn-sm ubah" data-toggle="modal" data-target="#ubahPengadaanModal" data-id_pengadaan="{{$peng->id_pengadaan}}" data-nama_pengadaan="{{$peng->nama_pengadaan}}" data-deskripsi="{{$peng->deskripsi}}" data-anggaran="{{$peng->anggaran}}"><i class="fas fa-edit"></i> Ubah</button> 

                        <a class="konfirmasi" href="/hapusPengadaan/{{$peng->id_pengadaan}}"><button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="d-flex justify-content-center">{{$pengadaan->links()}}</div>
            </div>
            <!-- /.card -->
          </div>
        </div>
       </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('parsial.footer')
  @include('pengadaan.tambah')
  @include('pengadaan.ubah')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('adminLTE/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('adminLTE/plugins/toastr/toastr.min.js')}}"></script>

<script type="text/javascript">
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    @if(\Session::has('berhasil'))
    Toast.fire({
      icon: 'success',
      title: '{{Session::get('berhasil')}}'
    })    
    @endif

    @if(\Session::has('gagal'))
    Toast.fire({
      icon: 'error',
      title: '{{Session::get('gagal')}}'
    })
    @endif

    @if(count($errors) > 0)
    Toast.fire({
      icon: 'error',
      title: '<ul>@foreach($errors->all() as $error) <li>{{$error}}</li>@endforeach</ul>'
    })
    @endif
  });

  function currency(){
    var input = document.getElementById('anggaran');
    $(".label_rp").val(formatRp(input.value));
  }

  function u_currency(){
    var input = document.getElementById('u_anggaran');
    $(".label_rp").val(formatRp(input.value));
  }

  function formatRp(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

  $(document).on("click", ".confGambar", function(event){
    event.preventDefault();
    const url = $(this).attr('href');

    var answer = window.confirm("Hapus Gambar?");
    if(answer){
      window.location.href = url;
    }else{
    }
  });

  $(document).on("click", ".ubah", function(){
    var id_pengadaan = $(this).data('id_pengadaan');
    var nama_pengadaan = $(this).data('nama_pengadaan');
    var deskripsi = $(this).data('deskripsi');
    var anggaran = $(this).data('anggaran');

    $(".id_pengadaan").val(id_pengadaan);
    $(".nama_pengadaan").val(nama_pengadaan);
    $(".deskripsi").val(deskripsi);
    $(".anggaran").val(anggaran);
  });

  $(document).on("click", ".konfirmasi", function(event){
    event.preventDefault();
    const url = $(this).attr('href');

    var answer = window.confirm("Hapus Data?");
    if(answer){
      window.location.href = url;
    }else{
    }
  });

</script>
</body>
</html>
