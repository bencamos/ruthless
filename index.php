<?php
session_start();
/*if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ruthless!</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- CSS Files -->
  <link href="Files/css/animate.min.css" rel="stylesheet">
  <link href="Files/css/bootstrap.min.css" rel="stylesheet">
  <link href="Files/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="Files/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo" style="margin-left: -266px;">
      </div>

      <nav id="navbar" class="navbar">
              <ul>
          <li><a class="nav-link scrollto" href="panel/index.php">Panel</a></li>
          <li class="dropdown"><a href="#avaliable"><span>Avaliable Services</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="ruthless-security.html">Ruthless Security</a></li>
              </li>
              <li><a href="ruthless-shopping.html">Ruthless Shopping Bot</a></li>
               <!-- <li><a href="#">Ruthless VPN</a></li>
              <li><a href="#">Ruthless Proxies</a></li>
              <li><a href="#">Ruthless Tor Bridges</a></li> -->
            </ul>
          </li>
          <li><b><a class="nav-link scrollto active" href="login.php">Sign In / Sign Up</a></b></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown" style="font-size: 75px"><a><span>RUTHLESS</span></a>
          </h2>
          <p class="animate__animated fanimate__adeInUp"> sample text here (adding descriptions soon)<!-- Ruthless is an up and coming company focused around security
            and privacy. While Ruthless is very focused on security and privacy our users do not have to sacrifice
            quality or a user-friendly experience. Read about our current services and even our coming soon services, we
            currently only offers a security evaluation service but much more is to come from Ruthless in the
            future! --> </p>
          <a href="#" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Ruthless Security</h2>
          <p class="animate__animated animate__fadeInUp"> sample text here (adding descriptions soon)<!-- Ruthless Security is one of the cheapest, fastest, and friendliest private, independant, small security companies around. Ethical hacking and penetration testing is one of the most important things when it comes to users AND companies safety regarding their data and devices. Ruthless security offers a range of different services regarding security for companies sites, servers, networks and applications. --></p>
          <a href="#" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Ruthless Shopping Bot</h2>
          <p class="animate__animated animate__fadeInUp"> sample text here (adding descriptions soon)<!-- Ruthless sneaker bot is soon to be the next Ruthless service. This sneaker bot is being prepared and tested to be the fastest, cheapest, safest, most compatible bot on the market. Along with that it will have frequent updates to beat anti-bot patches sites put out as fast as possible to insure you never miss out on a drop. --></p>
          <a href="#" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
          <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg>      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
          <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>      </a>

    </div>


  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </div>

        <ul class="faq-list">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">frequently asked question 1? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
                Answer 1.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">frequently asked question 2? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
                  Answer 2.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">frequently asked question 3? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
                  Answer 3.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Frequently asked question 4? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Answer 4.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Frequently asked question 5? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
              <p>
                 Answer 5.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Frequently asked question 6? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
              <p>
                Answer 6.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section><!-- End F.A.Q Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Ruthless<a><img src="Files/img/logo.png" width="80" height="50" alt="" class="img-fluid"></a></h3>
      <p>Always Remember If You're Not First You're Last...</p>
      <div class="copyright">
        &copy; Copyright <strong><span>Ruthless</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- JS Files -->
  <script src="Files/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Files/glightbox/js/glightbox.min.js"></script>
  <script src="Files/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="Files/js/main.js"></script>

</body>

</html>
