<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PENGADAAN</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('arsha/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('arsha/assets/img/apple-touch-icon.png')}} " rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('arsha/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('arsha/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('arsha/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha - v4.3.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">PENGAJUAN</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <!-- Include Menu-->
      @include('utama.menu')

    </div>
  </header><!-- End Header -->

  <main id="main">
  	<!-- CTA Section -->
  	<section id="cta" class="cta">
  		
  	</section>
    <!-- End CTA Section -->
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Registrasi</h2>
          <p>Daftarkan produk barang atau jasa Anda agar masuk ke dalam Sistem Pengadaan Barang & Jasa</p>
        </div>

        <div class="row">

          @if(\Session::has('berhasil'))
            <div class="alert alert-success" role="alert">
              {{Session::get('berhasil')}}
            </div>
          @endif

          @if(\Session::has('gagal'))
            <div class="alert alert-danger" role="alert">
              {{Session::get('gagal')}}
            </div>
          @endif       

          <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="/regist" method="post" role="form" class="php-email-form">
            	{{csrf_field()}}
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Nama Badan Usaha</label>
                  <input type="text" name="nama_badan" class="form-control" id="name">
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email">
                </div>
              </div>
              <div class="form-group">
                <label for="name">Alamat</label>
                <textarea class="form-control" name="alamat" rows="10"></textarea>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">No. NPWP</label>
                  <input type="text" name="npwp" class="form-control" id="npwp">
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
              </div>
              <div class="text-center"><button type="submit">Registrasi</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>PENGADAAN</h3>
            <p>
              Jalan Jend. Ahmad Yani No.XX <br>
              Kabupaten Karawang<br>
              Jawa Barat <br><br>
              <strong>Telepon:</strong> (0267) 555 666<br>
              <strong>Email:</strong> pengadaan@karawang.go.id<br>
            </p>
          </div>

          

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Jejaring Sosial Kami</h4>
            <p>Ikuti jejaring sosial kami untuk mengatahui perkembangan pengadaan barang dan jasa Kabupaten Karawang</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Kabupaten Karawang</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('arsha/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('arsha/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('arsha/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <!-- <script src="{{asset('arsha/assets/vendor/php-email-form/validate.js')}}"></script> -->
  <script src="{{asset('arsha/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('arsha/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('arsha/assets/js/main.js')}}"></script>

</body>

</html>