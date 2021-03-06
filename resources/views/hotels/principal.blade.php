<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DIINF++</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" type="text/css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/animate.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet"  type="text/css" href="{{URL::asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" type="text/css"  href="{{URL::asset('css/aos.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/css/ionicons.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.timepicker.css')}}">


    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/icomoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}">
  </head>
  <body>

<nav class="navbar navbar-expand-lg " id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="/">DIINF++</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
           <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="/flights" class="nav-link">Vuelos</a></li>
            <li class="nav-item"><a href="/destinies" class="nav-link">Alojamiento</a></li>
            <li class="nav-item"><a href="/cars" class="nav-link">Autos</a></li>
            <li class="nav-item"><a href="/packages" class="nav-link">Paquetes</a></li>

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->is_admin == 1)
                                    <a class="dropdown-item" href="/admin">Menú Admin</a>
                                    @endif
<!--                                    <a class="dropdown-item" href="{{ route('carrito', [Auth::user()->id])}}">Carrito de compras</a> -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <!-- END nav -->
    
    
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 sidebar order-md-last ftco-animate">
            @if(Auth::user())
            @if(Auth::user()->is_admin == 0)
            <div class="sidebar-wrap ftco-animate">
              <h3 class="heading mb-4">Buscar Alojo</h3>
              <form action="/hoteles/buscar" method="post">
                <div class="fields">
                  <div class="form-group">
                    <input type="text" name="lugar_destino" class="form-control" placeholder="Ingrese Destino">
                    <br>

                    <input type="text" name="fecha_ida" id="checkin_date" class="form-control checkin_date" placeholder="Fecha de Ida"><br>
                    <input type="text" name="fecha_vuelta" id="checkin_date" class="form-control checkin_date" placeholder="Fecha de Vuelta">

                  </div>
                  <input type="number" name="num_personas" value="2" class ="form-control" placeholder="Cantidad de Personas" style="text-align: left;">
                  <br>
                  <div class="form-group">
                    <input type="submit" value="Search" class="btn btn-primary py-3 px-5">
                  </div>
                </div>
              </form>
            </div>
            @endif
            @endif

          </div><!-- END-->

          <div class="col-lg-9">

            <div class="row">
                @foreach($destino as $destiny)

              <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                <div class="destination">
                  <a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{URL::asset('images/destination-3.jpg')}});">
                  </a>
                  <div class="text p-3">
                    <div class="d-flex">
                      <div class="one">
                        <h6>Ciudad: {{$destiny->ciudad}}</h3>

                      </div>
                      <div class="two">
                        <span class="price"></span>
                      </div>
                    </div>


                    <hr>
                   <form method="post" action="/hoteles/ciudad">
                    <input type="hidden"  value="{{$destiny}}" name="destino">
                    <input type="hidden"  value="{{$destiny->id}}" name="id_destino">
                    <p class="bottom-area d-flex">

                      <button type="submit" class="btn btn-info">Ver más</button>
                    </p>
                </form>

                    </p>
                  </div>
                </div>
              </div>
          @endforeach
          </div> <!-- .col-md-8 -->
        </div>
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

 <script src="{{URL::asset('js/jquery.min.js')}}"></script>
  <script src="{{URL::asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{URL::asset('js/popper.min.js')}}"></script>
  <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('js/jquery.easing.1.3.js')}}"></script>
  <script src="{{URL::asset('js/jquery.waypoints.min.js')}}"></script>
  <script src="{{URL::asset('js/jquery.stellar.min.js')}}"></script>
  <script src="{{URL::asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{URL::asset('js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{URL::asset('js/aos.js')}}"></script>
  <script src="{{URL::asset('js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{URL::asset('js/bootstrap-datepicker.js')}}"></script>
  <script src="{{URL::asset('js/jquery.timepicker.min.js')}}"></script>
  <script src="{{URL::asset('js/scrollax.min.js')}}"></script>
  <script src="{{URL::asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false')}}"></script>
  <script src="{{URL::asset('js/google-map.js')}}"></script>
  <script src="{{URL::asset('js/main.js')}}"></script>


  </body>
</html>
