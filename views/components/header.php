<?php 
/**
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var \App\Kernel\View\ViewInterface $view
 */

 $user = $auth->user();
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $view->title() ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Movie_store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="/assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="/assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start plugins -->
<script type="text/javascript" src="/assets/js/jquery-1.11.1.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<script src="/assets//assets/js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>
</head>
<body>
<div class="container">
<div class="header_top">
		    <div class="col-sm-3 logo"><a href="/">Главная</a></div>
		    <div class="col-sm-6 nav">
			  <ul>
				 <li> <span class="simptip-position-bottom simptip-movable" data-tooltip="обсуждения"><a href="#"> </a></span></li>
				 <li><span class="simptip-position-bottom simptip-movable" data-tooltip="трейлеры"><a href="#"> </a></span></li>
				 <li><span class="simptip-position-bottom simptip-movable" data-tooltip="игры"><a href="#"> </a></span></li>
				 <li><span class="simptip-position-bottom simptip-movable" data-tooltip="о сайте"><a href="#"> </a></span></li>
			 </ul>
			</div>
			<div class="col-sm-3 header_right">
			   <ul class="header_right_box">
			   <?php if(!$auth->check()) { ?>
				<a class="acount-btn" href="/login">Login</a>
				 </form>
				 <?php } ?>

                <?php if($auth->check()) { ?>
				 <li><img src="/assets/images/p1.png" alt=""/></li>
				 <li><p><?php echo $user->name() ?></p></li>
				 <form action="/logout" method="post">
				 <button style="margin-top: 4px; margin-left: 3px;">Выйти</button>
				 </form>
				 <?php if($user->admin() == 0) { ?>
					<a href="/admin">Админ панель</a>
				 <?php } ?>
				 <?php } ?>


				 <div class="clearfix"> </div>
			   </ul>
			</div>
			<div class="clearfix"> </div>
	      </div>
        </div>