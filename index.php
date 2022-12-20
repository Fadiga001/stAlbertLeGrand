<?php
header("Content-Type: text/html; charset=utf-8"); 
try {
    $connexion = new PDO('mysql:host=91.216.107.185;dbname=stalb1938159;charset=utf8','stalb1938159','i2ecgu8sh4');
    $connexion->exec('SET NAMES utf8');
} catch (Exception $e){
    die($e);
}

 header("Content-Type: text/html; charset=utf-8"); 

$query = $connexion->query('select * from ncontact where id_contact = (select max(id_contact) from ncontact)');
if ($query){
$contact = $query->fetch();
} else{
    $contact = null;
}


$query = $connexion->query('SELECT id_photo, libelle_photo, photo  FROM galerie ORDER BY id_photo DESC LIMIT 3');
if ($query){
    $galerie = $query->fetchAll();
} else{
    $galerie = null;
}

$query = $connexion->query('select * from evenements where DATE_EVENEMENT > CURDATE() LIMIT 1 ');
if (!empty($query)){
	$evenement = $query->fetch();
	if(!empty($evenement)){
		$date = $evenement['DATE_EVENEMENT'];
		$jour_event = date_format(date_create($evenement['DATE_EVENEMENT']),'d');
		$mois_event= date_format(date_create($evenement['DATE_EVENEMENT']),'m');
		$heure_event = date_format(date_create($evenement['DATE_EVENEMENT']),'H:i') ;	
	}
	
} else{
    $evenement = null;
    $date = null;
}



$query = $connexion->query('select * from evenements where DATE_EVENEMENT > CURDATE() ORDER BY DATE_EVENEMENT');
if (!empty($query)){
    $evenements = $query->fetchAll();
} else{
    $evenements = null;
}

$query = $connexion->query('select * from verset where ID_VERSET = (select max(ID_VERSET) from verset)');
if ($query){
    $verset = $query->fetch();
} else{
    $verset = null;
}

$query = $connexion->query('select * from information where id_info = (select max(id_info) from information)');
if ($query){
    $infos = $query->fetch();
} else{
    $infos = null;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>St Albert le grand - Accueil</title>
    <meta charset="UTF-8">
    <meta name="description" content="LibChurch Event Template">
    <meta name="keywords" content="event, libChurch, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="img/newLogo.jpeg" rel="shortcut icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="css/style.css" />


    <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body class="accueil">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- header top section -->
    <!--<div class="top-nav-section hidden-xs">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="social">
						<a href="#"><i class="ti-facebook"></i></a>
						<a href="#"><i class="ti-twitter-alt"></i></a>
						<a href="#"><i class="ti-google"></i></a>
						<a href="#"><i class="ti-instagram"></i></a>
					</div>
				</div>
				<div class="col-sm-6 col-md-7 col-lg-6">
					<div class="counter-top">
						<h5>Upcoming Event:</h5>
						<div class="counter">
							<div class="counter-item"><h4>10</h4>Days</div>
							<div class="counter-item"><h4>08</h4>hours</div>
							<div class="counter-item"><h4>40</h4>Mins</div>
							<div class="counter-item"><h4>56</h4>secs</div>
						</div>
						<a href="#" class="top-readmore hidden-sm">readmore</a>
					</div>
				</div>
				<div class="col-sm-3 col-md-2 col-lg-3">
					<div class="user-input">
						<a href="#">My account <i class="fa fa-angle-down"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	 header top section end-->


    <!-- Header section  -->
    <header class="header-section">
        <div class="container">
            <!-- logo -->
            <a href="index.php" class="site-logo"><img src="img/newLogo.jpeg" alt="" width="80" height="80"></a>

            <!-- nav menu -->
            <div class="nav-switch">
                <i class="fa fa-bars"></i>
            </div>
            <nav class="main-menu">
                <ul>
                    <li class="active"><a href="index.php">Accueil</a></li>
                    <li><a href="about.php">A Propos</a></li>
                    <li><a href="sermons.php">Commissions</a></li>
                    <li><a href="event.php">Informations</a></li>
                    <li><a href="blog.php">blog</a></li>
                    <li><a href="galerie.php">Galerie</a></li>
                    <li><a href="contact.php">Contacts</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Header section end -->

    <!-- Floting button section  -->
    <button class="floting-btn btn btn-warning ">
        <h5 class="info">Infos</h5>

        <?php if(!empty($infos)){ ?>

        <p class="tooltip">
            <strong class="btn btn-info"><?= $infos['titreInfo'] ?></strong> <br><br>
            <?= $infos['libelleInfo'] ?>
        </p>

        <?php }else{ ?>

        <p class="tooltip">
            <strong class="btn btn-info">St Albert le grand</strong> <br><br>
            La paroisse où il fait bon vivre.
        </p>

        <?php } ?>
    </button>
    <!-- Floting button section end -->

    <!-- Text animation section -->
    <div class="marquee-rtl text-light">
        <?php if(!empty($verset)){?>
        <div><?= $verset['LIBELLE_VERSET']?></div>
        <?php }else{ ?>
        <div>AUCUN VERSET DISPONIBLE POUR L'INSTANT.</div>
        <?php } ?>

    </div>

    <!-- Text animation section end -->



    <!-- Hero section -->
    <section class="hero-section set-bg" data-setbg="img/banniere.jpeg">
        <div class="hero-content">
            <div class="hc-inner">
                <div class="container">
                    <h2>Paroisse Saint Albert le Grand </h2>
                    <p>La paroisse où il fait bon vivre. </p>
                    <a href="about.php" class="site-btn sb-wide sb-line">
                        <center class="c"> En Savoir Pus Sur Nous </center>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section end -->


    <!-- Event section -->

    <script>
    var date = new Date("<?= $date?>");
    </script>

    <section class="event-section">
        <div class="container">
            <?php if(isset($date)){?>
            <div class="row">
                <div class="col-md-5 col-lg-6">
                    <!-- event info -->
                    <div class="event-info">
                        <div class="event-date">
                            <h2><?= $jour_event ?></h2>
                            <?= $mois_event ?>
                        </div>
                        <h3><?= $evenement['TITRE_EVENEMENT']?></h3>
                        <p><i class="fa fa-clock-o"></i> <?= $heure_event?> <i class="fa fa-map-marker"></i>
                            <?= $evenement['LIEU_EVENEMENT'] ?></p>
                    </div>
                </div>
                <div class="col-md-7 col-lg-6">
                    <!-- counter -->
                    <div class="counter">
                        <div class="counter-item j" id="jour"></div>
                        <div class="counter-item h" id="heure"></div>
                        <div class="counter-item m" id="minute"></div>
                        <div class="counter-item s" id="seconde"></div>
                    </div>
                    <!--<a href="" class="site-btn sb-light-line">Lire Plus</a>-->
                </div>
            </div>
            <?php } else {?>
            <div class="row">

                <div class="col-md-12 col-lg-12">
                    <!-- counter -->
                    <p align="center"><b><big class="text-light">AUCUN EVENEMENT PREVU POUR LES JOURS A
                                VENIR</big></b></p>
                    <!--<a href="" class="site-btn sb-light-line">Lire Plus</a>-->
                </div>
            </div>
            <?php }?>

        </div>
    </section>
    <!-- Event section end -->


    <!-- About section -->

    <section class="about-section spad">
        <div class="container">
            <div class="jumbotron">
                <h2>Rendons le monde meilleur ensemble</h2>
                <p>
                    Car Dieu n'a pas envoyé son Fils dans le monde pour condamner le monde,
                    mais pour sauver le monde à travers lui.
                </p>
            </div>

            <div class="row">
                <?php foreach ($galerie as $vue){ ?>
                    <?php if(!empty($vue)){ ?>
                        <div class="col-lg-4 col-xs-6" >
                            <div class="thumbnail">
                                <a href="http://ftp.stalbertlegrand-ci.net/adminStAlbert/<?=$vue['photo']?>">
                                    <img src="http://ftp.stalbertlegrand-ci.net/adminStAlbert/<?=$vue['photo']?>" class="img" />
                                </a>
                            </div>
                        </div>
                    <?php } else{  ?>
                        <div class="col-lg-4">
                            <div class="thumbnail">
                                <img src="img/banniere.jpeg" class="img" />
                            </div>
                        </div>
                    <?php } ?>

                <?php }?>
            
            </div>
        </div>
    </section>
    
    <!-- About section end -->


    <!-- Services section -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="service-box">
                        <h4><i class="fa fa-fire"></i>Nos valeurs</h4>
                        <p>Apporter la Bonne Nouvelle là où le besoin se fait sentir.</p>
                        <a href="about.php" class="s-readmore">Lire Plus <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="service-box">
                        <h4><i class="fa fa-eye"></i>Notre vision</h4>
                        <p>Apporter la Bonne Nouvelle là où le besoin se fait sentir.</p>
                        <a href="about.php" class="s-readmore">Lire Plus <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="service-box">
                        <h4><i class="fa fa-heart"></i>Notre Mission</h4>
                        <p>Apporter la Bonne Nouvelle là où le besoin se fait sentir.</p>
                        <a href="about.php" class="s-readmore">Lire Plus <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services section end -->


    <!-- Sermon section -->
    <section class="sermon-section spad">
        <div class="section-title">
            <h2>VERSET DU JOUR</h2>
        </div>
        <div class="sermon-warp text-center" style="height: 500px;">
            <?php if(!empty($verset)){?>
            <div class="sermon-left-bg set-bg" data-setbg="http://ftp.stalbertlegrand-ci.net/adminStAlbert/<?=$verset['photo']?>"></div>
            <div class="col-md-6 col-md-offset-6" style="display: flex; align-items: center; justify-content: center;">
                <div class="sermon-content col-md-6" style="width: 100%; overflow-wrap: break-word;">
                    <!-- <h2>Le Seigneur est suffisant pour tous nos besoins</h2> -->
                    <p class="b" align="justify"><?= $verset['LIBELLE_VERSET']?> (<?= $verset['REFERENCE']?>).</p>
                </div>
            </div>
            <?php }else{ ?>
            <p class="b" align="Center">AUCUN VERSET DISPONIBLE POUR L'INSTANT.</p>
            <?php } ?>
        </div>
    </section>
    <!-- Sermon section end -->


    <!-- Event list section -->
    <section class="event-list-section spad">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title title-left">
                        <h2>Evenements A Venir</h2>
                    </div>
                </div>
                <div class="col-md-6 text-right event-more">
                    <a href="event.php" class="site-btn">Voir Tous Les Evenements</a>
                </div>
            </div>
            <div class="event-list">
                <!-- event list item -->
                <?php foreach ( $evenements as $event ){ ?>

                <div class="el-item">
                    <div class="row">
                        <!--<div class="col-md-4">
							<div class="el-thubm set-bg" data-setbg="img/event/1.png"></div>
						</div>-->
                        <div class="col-md-8 eventbox">
                            <div class="el-content">
                                <div class="el-header">
                                    <div class="el-date">
                                        <h2><?= date_format(date_create($event['DATE_EVENEMENT']),'d'); ?></h2>
                                        <?= date_format(date_create($event['DATE_EVENEMENT']),'m'); ?>
                                    </div>
                                    <h3><?= $event['TITRE_EVENEMENT']?></h3>
                                    <div class="el-metas">
                                        <!--										<div class="el-meta"><i class="fa fa-user"></i> John Doe </div>-->
                                        <div class="el-meta"><i
                                                class="fa fa-clock-o"></i><?= date_format(date_create($evenement['DATE_EVENEMENT']),'H:i') ?>
                                        </div>
                                        <div class="el-meta"><i class="fa fa-map-marker"></i>
                                            <?= $event['LIEU_EVENEMENT']?></div>
                                    </div>
                                </div>
                                <!--<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
								<a href="" class="site-btn sb-line"> <h2 class="v">Lire Plus</h2> </a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- event list item -->
                <!--				<div class="el-item">-->
                <!--					<div class="row">-->
                <!--						<div class="col-md-4">-->
                <!--							<div class="el-thubm set-bg" data-setbg="img/event/2.png"></div>-->
                <!--						</div>-->
                <!--						<div class="col-md-8">-->
                <!--							<div class="el-content">-->
                <!--								<div class="el-header">-->
                <!--									<div class="el-date">-->
                <!--										<h2>16</h2>-->
                <!--											oct-->
                <!--									</div>-->
                <!--									<h3>Rencontre sur la radio et interview </h3>-->
                <!--									<div class="el-metas">-->
                <!--										<div class="el-meta"><i class="fa fa-user"></i> John Doe</div>-->
                <!--										<div class="el-meta"><i class="fa fa-calendar"></i> Mercredi, 08:00 Am </div>-->
                <!--										<div class="el-meta"><i class="fa fa-map-marker"></i> Paroise St Albert, Cocody </div>-->
                <!--									</div>-->
                <!--								</div>-->
                <!--								<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>-->
                <!--								<a href="" class="site-btn sb-line"> <h2 class="v">Lire Plus</h2></a>-->
                <!--							</div>-->
                <!--						</div>-->
                <!--					</div>-->
                <!--				</div>-->
                <!--			</div>-->
            </div>
    </section>
    <!-- Event list section end-->


    <!-- Donate section -->
    <!--<section class="donate-section spad set-bg" data-setbg="img/donate-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 donate-content">
					<h2>A Children’s Miracle Network Hospital</h2>
					<ul class="donate-info">
						<li>Sermon From: <span>Vincent John</span></li>
						<li>Categories: <span>God, Pray</span></li>
						<li><span>On Monday 23 DEC, 2018</span></li>
					</ul>
					<p>For God did not send his Son into the world to condemn the world, but to save the world through him. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia dese mollit anim id est laborum. Sed ut perspiciatis unde omnis iste.</p>
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="donate-card">
						<h2>$45.000<span>Remaining to helps</span></h2>
						<div class="donate-progress-bar">
							<div class="pb-inner">
								<span>60%</span>
							</div>
						</div>
						<div class="donate-progress-info">
							<div class="di-left">
								Raised: <span>$50,000</span>
							</div>
							<div class="di-right">
								Goal: <span>$95,000</span>
							</div>
						</div>
						<a href="" class="site-btn sb-full">DONATE NOW</a>
					</div>
				</div>
			</div>
		</div>
	</section>-->
    <!-- Donate section end-->


    <!-- Blog section -->
    <!--<section class="blog-section spad">
		<div class="container">
			<div class="section-title">
				<span>Blog de l'eglise</span>
				<h2>Dernieres Nouvelles</h2>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="blog-item">
						<div class="bi-thumb set-bg" data-setbg="img/blog/1.jpg"></div>
						<div class="bi-content">
							<div class="date">Vendredi 7 fevrier, 2020</div>
							<h4><a href="single-blog.html">Evenement sur la paroise 1</a></h4>
							<div class="bi-author">by <a href="#">Tou Mimi</a></div>
							<a href="#" class="bi-cata">Hope & Faithful</a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="blog-item">
						<div class="bi-thumb set-bg" data-setbg="img/blog/2.jpg"></div>
						<div class="bi-content">
							<div class="date">Vendredi 7 fevrier, 2020</div>
							<h4><a href="single-blog.html">Evenement sur la paroise 2</a></h4>
							<div class="bi-author">by <a href="#">Tou Mimi</a></div>
							<a href="#" class="bi-cata">color Story</a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="blog-item">
						<div class="bi-thumb set-bg" data-setbg="img/blog/3.jpg"></div>
						<div class="bi-content">
							<div class="date">Vendredi 7 fevrier, 2020</div>
							<h4><a href="single-blog.html">Evenement sur la paroise 3</a></h4>
							<div class="bi-author">by <a href="#">Tou Mimi</a></div>
							<a href="#" class="bi-cata">Sermon & Pray</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>-->
    <!-- Blog section end-->


    <!-- Newsletter section -->
    <!--<section class="newsletter-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-7">
					<h4>Subscribe And Tell Us Real Story About Your Journey</h4>
				</div>
				<div class="col-sm-8 col-md-5 col-sm-offset-2 col-md-offset-0">
					<form class="newsletter-form">
						<input type="email" placeholder="Enter your email">
						<button class="nl-send-btn">subscribe</button>
					</form>
				</div>
			</div>
		</div>
	</section>-->
    <!-- Newsletter section end-->


    <!-- Footer top section -->
    <section class="footer-top-section spad footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 footer-top-content">
                    <div class="section-title title-left">
                        <h2>Contacts</h2>
                    </div>

                    <?php if(!empty($contact)){?>

                        <h3><?=$contact['pays']?></h3>
                        <p><?=$contact['ville']?></p>
                        <p><span>Email:</span> <?=$contact['Email']?></p>
                        <h4>Numéros:</h4>
                        <h5><?=$contact['Numero_un']?> / <?=$contact['Numero_deux']?> </h5>
                    <?php }else{ ?>
                    <p class="b" align="JUSTIFY">AUCUNE INFORMATION DISPONIBLE POUR L'INSTANT.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- googel map -->
        <div class="map-area"> <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3972.448773367355!2d-3.993921!3d5.348266!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1eb7ba68b2a4f%3A0xe90f85d2af5d3354!2sEglise%20Catholique%20ST%20ALBERT%20LE%20GRAND!5e0!3m2!1sfr!2sus!4v1605056053884!5m2!1sfr!2sus"
                width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe></div>
    </section>
    <!-- Footer top section end-->


    <!-- Footer section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class=" copyright">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p class="b" align="Center">Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                        </script> <a class="copy" href="http://softnfix.com/">SOFTN'FIX TECHNOLOGY-TOUS DROITS RÉSERVÉS.</a>  <a class="admin" href="http://ftp.stalbertlegrand-ci.net/adminStAlbert/">SAINT ALBERT LE GRAND</a></p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>

            </div>
        </div>
    </footer>
    <!-- Footer section end -->


    <!--====== Javascripts & Jquery ======-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!--<script src="js/jquery.countdown.js"></script>-->
    <script src="js/main.js"></script>

    <script src="js/yo.js"></script>
    <!-- load for map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0YyDTa0qqOjIerob2VTIwo_XVMhrruxo"></script>
    <script src="js/map.js"></script>


</body>

</html>