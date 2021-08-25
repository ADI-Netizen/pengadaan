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
    @include('parsial.suppSetting')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      @include('parsial.suppUsername')

      <!-- Sidebar Menu -->
      @include('parsial.suppMenu')
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
                       <img src="{{asset(Storage::url($peng->gambar))}}" style="width: 200px;">
                      </td>
                      <td><span class="tag tag-success">{{number_format($peng->anggaran,0,",",".")}}</span></td>
                      <td>
                        <button class="tn btn-outline-secondary btn-sm tambah" data-id_pengadaan="{{$peng->id_pengadaan}}" data-nama_pengadaan="{{$peng->nama_pengadaan}}" data-anggaran="{{$peng->anggaran}}" data-toggle="modal" data-target="#pengajuanModal"><i class="fas fa-plus-circle"></i>  Ajukan</button>
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
  @include('login_supp.pengajuan')

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
    var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
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

  $(document).on("click", ".konfirmasi", function(event){
    event.preventDefault();
    const url = $(this).attr('href');

    var answer = window.confirm("Hapus Data?");
    if(answer){
      window.location.href = url;
    }else{
    }
  });

  $(document).on("click", ".tambah", function(){
    var id_pengadaan = $(this).data('id_pengadaan');
    var nama_pengadaan = $(this).data('nama_pengadaan');
    var anggaran = $(this).data('anggaran');var alamat = $(this).data('alamat');

    $(".id_pengadaan").val(id_pengadaan);
    $(".nama_pengadaan").val(nama_pengadaan);
    $(".anggaran").val(anggaran);
    $(".label_rp").val(formatRp(anggaran,''));

  });

</script>
</body>
</html>
