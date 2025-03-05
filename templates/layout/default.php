<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ibafai Pipaklub • 2025</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="//img/favicon.png" rel="icon">
  <link href="//img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/vendor/aos/aos.css" rel="stylesheet">
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<?php
	/*
		echo $this->Html->css([
			"/vendor/sweetalert2/dist/sweetalert2.min",
			"/vendor/simple-notify-gh-pages/dist/simple-notify",	// Toast messages			
		]);
		//echo $this->fetch('css');	
		echo $this->fetch('script');
		*/
?>


  <!-- Template Main CSS File -->
  <link href="/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center text-bg-danger">
    <div class="container d-flex justify-content-center">
      <div class="contact-info d-flex align-items-center text-white text-center px-1 fw-bold">
		Az oldal fejlesztés alatt van. Egyelőre csak a legfontosabb információkat tesszük fel.
	  </div>
    </div>
  </section>

  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:info@ibafaipipaklub.hu">info@ibafaipipaklub.hu</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+36 30/...-..-.. <i>(később)</i></span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <!--a href="#" class="twitter"><i class="bi bi-twitter" target="_new"></i></a-->
        <a href="https://www.facebook.com/groups/241706954165988" class="facebook" target="_new"><i class="bi bi-facebook"></i></a>
        <!--a href="#" class="instagram"><i class="bi bi-instagram" target="_new"></i></a-->
        <!--a href="#" class="linkedin"><i class="bi bi-linkedin" target="_new"></i></i></a-->
      </div>
    </div>
  </section>


	<?= $this->element("header") ?>

	<?php
		if($this->request->getUri()->getPath() == '/'){
			echo $this->element("hero");
		}
	?>

  <main id="main">

	<?php
		if($this->request->getUri()->getPath() == '/'){
			echo $this->element("cta");
		}
	?>

	<?= $this->fetch("content") ?>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Ibafai Pipaklub</h3>
            <p>
              7700 Ibafa <br>
              Kossuth u. 123.<br>
              <br>
              <!--strong>Phone:</strong> +1 5589 55488 55<br-->
              <strong>Email:</strong> info@ibafaipipaklub.hu<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="/"><?= __('Home') ?></a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/rolunk"><?= __('About us') ?></a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/blog"><?= __('Blog') ?></a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/kapcsolat"><?= __('Contact') ?></a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="/cookies"><?= __('Cookies') ?></a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/tos"><?= __('Terms of service') ?></a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/pp"><?= __('Privacy policy') ?></a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Az oldal fejlesztés alatt van!</h4>
            <p>Egyelőre csak a legfontosabb eseményeket, cikkeket tesszük fel.</p>
            <!--form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form-->
          </div>

          <!--div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div-->

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Ibafai Pipaklub</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- Made by <a href="https://github.com/codeandpipesmoke">Code And Pipesmoke</a> -->
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <!--a href="#" class="twitter"><i class="bx bxl-twitter"></i></a-->
        <a href="https://www.facebook.com/groups/241706954165988" class="facebook" target="_new"><i class="bx bxl-facebook"></i></a>
        <!--a href="#" class="instagram"><i class="bx bxl-instagram"></i></a-->
        <!--a href="#" class="google-plus"><i class="bx bxl-skype"></i></a-->
        <!--a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a-->
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/vendor/aos/aos.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/js/main.js"></script>

</body>

</html>