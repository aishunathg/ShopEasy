<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>ShopEasy</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="<?php echo base_url() ?>public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="<?php echo base_url() ?>public/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
		<link href="<?php echo base_url() ?>public/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="<?php echo base_url() ?>public/css/flexslider.css" rel="stylesheet"/>
		<link href="<?php echo base_url() ?>public//css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="<?php echo base_url() ?>public/js/jquery-1.7.2.min.js"></script>
		<script src="<?php echo base_url() ?>public/css/bootstrap/js/bootstrap.min.js"></script>				
		<script src="<?php echo base_url() ?>public/js/superfish.js"></script>	
		<script src="<?php echo base_url() ?>public/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">

				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">	
						<li><a href="<?php echo site_url('home') ?>">Home</a></li>	
						<?php if($this->session->isLoggedIn) { ?>	
							<li><a href="<?php echo site_url('home/ordermanagement') ?>">Orders</a></li>		
							<li><a href="<?php echo site_url('home/cart') ?>">Cart</a></li>						
							<li><a href="<?php echo site_url('logout') ?>">Logout</a></li>	
                        <?php } else { ?>
                            <li><a href="<?php echo site_url('user/login') ?>">Login</a></li>	
                            <li><a href="<?php echo site_url('user/register') ?>">Register</a></li>	
                        <?php } ?>		
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					
				</div>
			</section>	
			<section class="header_text sub">
			<img class="pageBanner" src="<?php echo base_url() ?>public/img/pageBanner.png" alt="New products" >
				<h4><span><?php echo $title ?></span></h4>
			</section>
			<section class="main-content">
				
				<div class="row">	
        <?php $this->load->view($_view); ?>

        </div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="#">Homepage</a></li>  
							<li><a href=".#">About Us</a></li>
							<li><a href="#">Contac Us</a></li>
							<li><a href="#">Your Cart</a></li>
							<li><a href="#l">Login</a></li>							
						</ul>					
					</div>
					<!--<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order History</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Newsletter</a></li>
						</ul>
					</div>-->
					<div class="span5">
						<p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
						<br/>
						<span class="social_icons">
							<a class="facebook" href="#">Facebook</a>
							<a class="twitter" href="#">Twitter</a>
							<a class="skype" href="#">Skype</a>
							<a class="vimeo" href="#">Vimeo</a>
						</span>
					</div>					
				</div>	
			</section>
			<!--<section id="copyright">
				<span> <?php echo date('Y') ?>  </span>
			</section>-->
		</div>
		<script src="themes/js/common.js"></script>	
    </body>
</html>