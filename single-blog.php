<?php
header("Content-Type: text/html; charset=utf-8"); 
try {
    $connexion = new PDO('mysql:host=91.216.107.185;dbname=stalb1938159;charset=utf8','stalb1938159','i2ecgu8sh4');
	$connexion->exec('SET NAMES utf8');
} catch (Exception $e){
    die($e);
}
if (isset($_GET['article'])){
    $query = $connexion->prepare('select * from articles where ID_ARTICLE = ?');
    $execution = $query->execute(array($_GET['article']));
    if ($execution){
        $article = $query->fetch();
    } else{
        $article = null;
    }
} else{
    header("location: blog.php");
}
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>St Albert le grand - Blog</title>
	<meta charset="UTF-8">
	<meta name="description" content="LibChurch Event Template">
	<meta name="keywords" content="event, libChurch, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/icon.png" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/themify-icons.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body class="single-blog">
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- header top section -->
	<header class="header-section">
		<div class="container">		
			<!-- logo -->
			<a href="index.php" class="site-logo"><img src="img/icon.png" alt="" width="80" height="80"></a>
			
			<!-- nav menu -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<nav class="main-menu">
				<ul>
					<li><a href="index.php">Accueil</a></li>
					<li><a href="about.php">A Propos</a></li>
					<li><a href="sermons.php">Commissions</a></li>
					<li><a href="event.php">Informations</a></li>
					<li  class="active"><a href="blog.php">blog</a></li>
					<li><a href="contact.php">Contacts</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="img/bg.jpg">
		<div class="page-info-content">
			<div class="pi-inner">
				<div class="container">
					<h2>Blog</h2>
					<div class="site-breadcrumb">
						<a href="#">Home</a> <i class="fa fa-angle-right"></i>
						<span>Blog</span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Page info section end -->
	

	<!-- Page section section -->
	<section class="page-section spad">
		<div class="container">
			<div class="row">
				<!-- Single blog post -->
				<div class="col-md-8 single-post">
					<figure class="post-thumb">
						<img src="img/blog/1.jpg" alt="">
					</figure>
					<div class="post-content" style="word-wrap: break-word;">
						<div class="date"><?= strftime('%A %d %B %Y, %I:%M',strtotime($article['DATE_PUBLICATION']))?></div>
						<h2 class="post-title"><?= $article['TITRE_ARTICLE']?></h2>
						<div class="post-metas">
							<div class="post-meta">Auteur <a href="#"><?= $article['auteur_article']?></a></div>
						</div>
						<p><?= $article['LIBELLE_ARTICLE']?></p>
					</div>
					<!--<div class="row">
						<div class="col-sm-7">
							<div class="post-tags">
								<a href="#">Hope & Faithful</a>
								<a href="#">color Story</a>
								<a href="#">Sermon & Pray</a>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="social-share">
								<p>Share</p>
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-google-plus"></i></a>
								<a href=""><i class="fa fa-instagram"></i></a>
							</div>
						</div>-->
					<!--</div>
					<div class="post-nav">
						<a href="" class="prev-post"><i class="fa fa-angle-double-left"></i> Previous Post</a>
						<a href="" class="next-post">Next Post <i class="fa fa-angle-double-right"></i></a>
					</div>-->
					<!-- comment form -->
					<!--<form class="comment-form">
						<h2>Leave a comment</h2>
						<input type="text" placeholder="Name">
						<input type="email" placeholder="Email">
						<input type="text" placeholder="Website">
						<textarea placeholder="Messeges"></textarea>
						<button type="submit" class="site-btn">Send message</button>
					</form>-->
				</div>
				<!-- sidebar -->
<!--				<div class="col-md-4 col-sm-6 sidebar">-->
					<!-- widget -->
<!--					<div class="widget">-->
<!--						<form class="search-widget">-->
<!--							<input type="text" placeholder="Search...">-->
<!--							<button><i class="fa fa-search"></i></button>-->
<!--						</form>-->
<!--					</div>-->
					<!-- widget -->
					<!--<div class="widget">
						<h4 class="widget-title">Categories</h4>
						<ul>
							<li><a href="">Color Story</a></li>
							<li><a href="">Hope & Faithful</a></li>
							<li><a href="">Pray & Church</a></li>
							<li><a href="">Prayer & God</a></li>
							<li><a href="">Sermon & Pray</a></li>
						</ul>
					</div>-->
					<!-- widget -->
					<!--<div class="widget">
						<h4 class="widget-title">Recent News</h4>
						<div class="recent-post-widget">
							<div class="rp-item">
								<div class="rp-thumb set-bg" data-setbg="img/blog/widget/1.jpg"></div>
								<div class="rp-content">
									<p>On Monday 13 May, 2018</p>
									<h5>Meet Our 2018 Patient Ambassadors</h5>
								</div>
							</div>
							<div class="rp-item">
								<div class="rp-thumb set-bg" data-setbg="img/blog/widget/2.jpg"></div>
								<div class="rp-content">
									<p>On Monday 13 May, 2018</p>
									<h5>Meet Our 2018 Patient Ambassadors</h5>
								</div>
							</div>
							<div class="rp-item">
								<div class="rp-thumb set-bg" data-setbg="img/blog/widget/3.jpg"></div>
								<div class="rp-content">
									<p>On Monday 13 May, 2018</p>
									<h5>Meet Our 2018 Patient Ambassadors</h5>
								</div>
							</div>
							<div class="rp-item">
								<div class="rp-thumb set-bg" data-setbg="img/blog/widget/4.jpg"></div>
								<div class="rp-content">
									<p>On Monday 13 May, 2018</p>
									<h5>Meet Our 2018 Patient Ambassadors</h5>
								</div>
							</div>
						</div>
					</div>
					 widget
					<div class="widget">
						<h4 class="widget-title">Archives</h4>
						<ul class="archive">
							<li><a href="">February 2018</a></li>
							<li><a href="">June 2017</a></li>
							<li><a href="">March 2016</a></li>
							<li><a href="">November 2015</a></li>
						</ul>
					</div>-->

					<!-- widget --><!--
					<div class="widget">
						<h4 class="widget-title">Popular Tags</h4>
						<div class="tags">
							<a href="#">Creative</a>
							<a href="#">Unique</a>
							<a href="#">Photography</a>
							<a href="#">Pray</a>
							<a href="#">Wordpress Template</a>
							<a href="#">Church</a>
						</div>
					</div>-->
				</div>
			</div>
		</div>
	</section>
	<!-- Page section section end-->


	<!-- Newsletter section -->
	<!-- Newsletter section end-->


	<!-- Footer top section -->
	<section class="footer-top-section spad footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 footer-top-content">
					<div class="section-title title-left">
						<h2>Contact Us</h2>
					</div>
					<h3>New York, USA</h3>
					<p>207 Park Avenue New York, NY 90210</p>
					<p><span>Email:</span> info@colorlib.com</p>
					<h4>Phone:</h4>
					<h5>+1 (409) 987–4567</h5>
				</div>
			</div>
		</div>
		<!-- googel map -->
        <div class="map-area" > <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3972.448773367355!2d-3.993921!3d5.348266!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1eb7ba68b2a4f%3A0xe90f85d2af5d3354!2sEglise%20Catholique%20ST%20ALBERT%20LE%20GRAND!5e0!3m2!1sfr!2sus!4v1605056053884!5m2!1sfr!2sus" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
	</section>
	<!-- Footer top section end-->


	<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 copyright">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;</script> <a class="copy" href="http://softnfix.com/">SOFTN'FIX TECHNOLOGY-TOUS DROITS RÉSERVÉS.</a> <a class="admin" href="http://ftp.stalbertlegrand-ci.net/adminStAlbert/">SAINT ALBERT LE GRAND</a></p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</div>
				<div class="col-sm-6">
					<div class="social">
						<a href="#"><i class="ti-facebook"></i></a>
						<a href="#"><i class="ti-twitter-alt"></i></a>
						<a href="#"><i class="ti-google"></i></a>
						<a href="#"><i class="ti-instagram"></i></a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/jquery.countdown.js"></script>
	<script src="js/main.js"></script>

	<!-- load for map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0YyDTa0qqOjIerob2VTIwo_XVMhrruxo"></script>
	<script src="js/map.js"></script>
	
</body>
</html>