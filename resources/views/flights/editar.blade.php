@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DIINF++</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

       <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/aos.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}" type="text/css">


    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
  </head>
  <body>

    <!-- END nav -->

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 text-center order-md-last ftco-animate">
            <div class="sidebar-wrap ftco-animate">
              <h3 class="heading mb-4">Editar Vuelo</h3>
              <form action="{{route('flights.update', $flight)}}" method="post">
                @method('PATCH')
                @csrf
                <div class="fields">
                  <div class="form-group">
                    <input type="text" name="precio" class="form-control" placeholder="Precio" required value={{$flight->precio}}>
                  </div>

                  <div class="form-group">
                    <input type="text" name="fecha_ida" id="checkin_date" class="form-control checkin_date" required placeholder="Fecha de Inicio" value={{$flight->fecha_ida}}>
                  </div>

                  <div class="form-group">
                    <input type="text" name="fecha_vuelta" id="checkin_date" class="form-control checkin_date" required placeholder="Fecha de Termino" value={{$flight->fecha_vuelta}}>
                  </div>

                  <div class="form-group">
                    <input type="text" name="origin_id" class="form-control" placeholder="Id Origen" required value={{$flight->origin_id}}>
                  </div>

                  <div class="form-group">
                    <input type="text" name="destiny_id" class="form-control" placeholder="Id Destino" required value={{$flight->destiny_id}}>
                  </div>

                  <div class="form-group">
                    <input type="text" name="package_id" class="form-control" placeholder="Id Paquete" value={{$flight->package_id}}>
                  </div>

                  <div class="form-group">
                    <input type="submit" value="Guardar cambios" class="btn btn-primary py-3 px-5">
                  </div>
                </div>
              </form>
            </div>

          </div><!-- END-->


      </div>
    </section> <!-- .section -->

    <section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2>Subcribe to our Newsletter</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
              <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-8">
                  <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Adventure</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About Us</a></li>
                <li><a href="#" class="py-2 d-block">Online enquiry</a></li>
                <li><a href="#" class="py-2 d-block">Call Us</a></li>
                <li><a href="#" class="py-2 d-block">General enquiries</a></li>
                <li><a href="#" class="py-2 d-block">Booking Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
                <li><a href="#" class="py-2 d-block">Refund policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Experience</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Beach</a></li>
                <li><a href="#" class="py-2 d-block">Adventure</a></li>
                <li><a href="#" class="py-2 d-block">Wildlife</a></li>
                <li><a href="#" class="py-2 d-block">Honeymoon</a></li>
                <li><a href="#" class="py-2 d-block">Nature</a></li>
                <li><a href="#" class="py-2 d-block">Party</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Have a Questions?</h2>
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                  <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/scrollax.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script type="text/javascript" src="{{ asset('js/google-map.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

  </body>
</html>
