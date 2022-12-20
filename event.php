<?php
header("Content-Type: text/html; charset=utf-8"); 
try {
    $connexion = new PDO('mysql:host=91.216.107.185;dbname=stalb1938159;charset=utf8','stalb1938159','i2ecgu8sh4');
    $connexion->exec('SET NAMES utf8');
} catch (Exception $e){
    die($e);
}

$query = $connexion->query('select * from ncontact where id_contact = (select max(id_contact) from ncontact)');
if ($query){
$contact = $query->fetch();
} else{
    $contact = null;
}

$query = $connexion->query('select * from evenements where DATE_EVENEMENT > CURDATE() LIMIT 1 ');
if ($query){
	$evenement = $query->fetch();
	if(!empty($evenement)){
		$date = $evenement['DATE_EVENEMENT'];
		$jour_event = date_format(date_create($evenement['DATE_EVENEMENT']),'d');
		$mois_event= date_format(date_create($evenement['DATE_EVENEMENT']),'M');
		$heure_event = date_format(date_create($evenement['DATE_EVENEMENT']),'H:m') ;	
	}
} else{
    $evenement = null;
    $date = null;
}
$query = $connexion->query('select * from evenements where  DATE_EVENEMENT > CURDATE() order by DATE_EVENEMENT ASC');
if (!empty($query)){
    $evenements = $query->fetchAll();
} else{
    $evenements = null;
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
    <title>St Albert le grand - Informations</title>
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

<body class="event">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- header top section -->
    <!-- header top section end-->


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
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="about.php">A Propos</a></li>
                    <li><a href="sermons.php">Commissions</a></li>
                    <li class="active"><a href="event.php">Informations</a></li>
                    <li><a href="blog.php">blog</a></li>
                    <li><a href="galerie.php">Galerie</a></li>
                    <li><a href="contact.php">Contacts</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Header section end -->


    <!-- Page info section -->
    <section class="page-info-section set-bg" data-setbg="img/interne.jpeg">
        <div class="page-info-content">
            <div class="pi-inner">
                <div class="container">
                    <h2>Informations</h2>
                    <div class="site-breadcrumb">
                        <a href="#">Accueil</a> <i class="fa fa-angle-right"></i>
                        <span>Informations</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page info section end -->

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
                    <p align="center"><b><big>AUCUN EVENEMENT PREVU POUR LES JOURS A VENIR</big></b></p>
                    <!--<a href="" class="site-btn sb-light-line">Lire Plus</a>-->
                </div>
            </div>
            <?php }?>

        </div>
    </section>
    <!-- Event section end -->



    <!-- Event list section -->
    <section class="event-list-section spad ">
        <div class="container center-block">
            <div class="section-title title-left">
                <h2>Evenements à Venir</h2>
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
                                        <?= date_format(date_create($event['DATE_EVENEMENT']),'M'); ?>
                                    </div>
                                    <h3><?= $event['TITRE_EVENEMENT']?></h3>
                                    <div class="el-metas">
                                        <!--										<div class="el-meta"><i class="fa fa-user"></i> John Doe </div>-->
                                        <div class="el-meta"><i
                                                class="fa fa-clock-o"></i><?= date_format(date_create($evenement['DATE_EVENEMENT']),'H:m') ?>
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
            </div>
        </div>
    </section>
    <!-- Event list section end-->


    <!-- Newsletter section -->
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
                        </script> <a class="copy" href="http://softnfix.com/">SOFTN'FIX TECHNOLOGY-TOUS DROITS RÉSERVÉS.</a> <a class="admin" href="http://ftp.stalbertlegrand-ci.net/adminStAlbert/">SAINT ALBERT LE GRAND</a></p>
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

</body b>

</html>