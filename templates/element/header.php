<?php
	$menu_home = '';
	$menu_about = '';
	$menu_blog = '';
	$menu_otherpages = '';
	$menu_contact = '';

	$plugin = $this->request->getParam('plugin');
	$controller = $this->request->getParam('controller');
	$action = $this->request->getParam('action');
	$pass = $this->request->getParam('pass');
	
	//debug($plugin);
	//debug($controller);
	//debug($action);
	//dd($pass);

	if($controller == 'Posts' && $action == 'index' && isset($pass[0]) && $pass[0] == 'news'){
		$menu_home = ' class="active"';
	}
	if($controller == 'Posts' && $action == 'index' && isset($pass[0]) && $pass[0] == 'blog'){
		$menu_blog = ' class="active"';
	}
	if($controller == 'Abouts' && $action == 'view'){
		$menu_about = ' class="active"';
	}
	if($controller == 'Otherpages' && $action == 'index'){
		$menu_otherpages = ' class="active"';
	}
	if($controller == 'Messages' && $action == 'add'){
		$menu_contact = ' class="active"';
	}
?>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="/"><img src="/img/logo.png" alt="" class="img-fluid floag-left"> Ibafai Pipaklub</a></h1>
        <!--a href="/"><img src="/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a<?= $menu_home ?> href="/"><?= __("Home") ?></a></li>
          <li><a<?= $menu_about ?> href="/rolunk"><?= __("About us") ?></a></li>
          <!--li><a href="services.html">Services</a></li-->
          <!--li><a href="testimonials.html">Testimonials</a></li-->
          <!--li><a href="pricing.html">Pricing</a></li-->
          <!--li><a href="portfolio.html">Portfolio</a></li-->
          <li><a<?= $menu_blog ?> href="/blog"><?= __("Blog") ?></a></li>
          <li><a<?= $menu_otherpages ?> href="/partner-sites"><?= __("Other pages") ?></a></li>
          <!--li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li-->
          <li><a<?= $menu_contact ?> href="/kapcsolat"><?= __('Contact') ?></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->