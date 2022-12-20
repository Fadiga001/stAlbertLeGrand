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
$query = $connexion->query('select * from pretres order by FONCTION');
if ($query){
    $pretres = $query->fetchAll();
} else{
    $pretres = null;
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
    <title>St Albert le grand - A Propos</title>
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

<body class="about">
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
                    <li class="active"><a href="about.php">A Propos</a></li>
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

    <!-- Page info section -->
    <section class="page-info-section set-bg" data-setbg="img/interne.jpeg">
        <div class="page-info-content">
            <div class="pi-inner">
                <div class="container">
                    <h2>A Propos</h2>
                    <div class="site-breadcrumb">
                        <a href="#">Accueil</a> <i class="fa fa-angle-right"></i>
                        <span>A Propos</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page info section end -->
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

    <!-- About section -->
    <section class="about-section spad">
        <div class="container">
            <div class="row">
                <h2 align="center">NOTRE CREATION</h2> <br>
                <p class="story">La paroisse Saint Albert Le Grand de Cocody a été créée le 24 février 2000 par le
                    Cardinal Bernard AGRE avec pour Curé le Père GOA IBO Jean Maurice. En effet, dans sa vision
                    d’apporter la Bonne Nouvelle là où le besoin se fait sentir, l’Archevêque d’Abidjan d’alors,
                    Monseigneur Bernard YAGO a entrepris auprès des autorités de l’Université d’Abidjan la mise en place
                    d’une aumônerie dénommée le Centre Catholique des Etudiants d’Abidjan. Créé en 1962, ce centre a eu
                    sa gestion confiée à la congrégation des Dominicains. A sa nomination à la tête de l’Archidiocèse,
                    Monseigneur Bernard AGRE nommera un prêtre diocésain, le Père Augustin OHUA en qualité d’Aumônier
                    universitaire en charge du Centre, charge qu’il exercera jusqu’en 1999.</p>
                <p class="story">Compte tenu du démembrement de l’Université Nationale de Côte d’Ivoire en universités
                    de Cocody et d’Abobo-Adjamé, et vue l’implantation de multitudes de Grandes Ecoles tant publiques
                    que privées, et dans l’optique de lui donner une personnalité juridique, le Cardinal Bernard AGRE
                    décide de l’érection du Centre Catholique des Etudiants d’Abidjan en une paroisse Universitaire à la
                    fois territoriale et personnelle. Celle-ci est rattachée au Secteur Centre Lagune (selon le
                    découpage propre au diocèse d’Abidjan). A ce jour, cette jeune paroisse a été dirigée par deux Curés
                    : les Révérends Pères Jean Maurice IBO GOA (de 2000 à 2007) et François De Paule Abey ABONGA (de
                    2007 à ce jour).</p>
                <p class="story">Compte tenu du démembrement de l’Université Nationale de Côte d’Ivoire en universités
                    de Cocody et d’Abobo-Adjamé, et vue l’implantation de multitudes de Grandes Ecoles tant publiques
                    que privées, et dans l’optique de lui donner une personnalité juridique, le Cardinal Bernard AGRE
                    décide de l’érection du Centre Catholique des Etudiants d’Abidjan en une paroisse Universitaire à la
                    fois territoriale et personnelle. Celle-ci est rattachée au Secteur Centre Lagune (selon le
                    découpage propre au diocèse d’Abidjan). A ce jour, cette jeune paroisse a été dirigée par deux Curés
                    : les Révérends Pères Jean Maurice IBO GOA (de 2000 à 2007) et François De Paule Abey ABONGA (de
                    2007 à ce jour).</p>

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
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="service-box">
                        <h4><i class="fa fa-eye"></i>Notre Vision</h4>
                        <p>Apporter la Bonne Nouvelle là où le besoin se fait sentir.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="service-box">
                        <h4><i class="fa fa-heart"></i>Notre Mission</h4>
                        <p>Apporter la Bonne Nouvelle là où le besoin se fait sentir.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services section end -->


    <script>
    var date = new Date("<?= $date?>");
    </script>


    <!-- Event section end -->


    <!-- Pastors section -->
    <section class="pastors-section spad">
        <div class="container">
            <div class="section-title">
                <span> </span>
                <h2>Nos Prêtres</h2>
            </div>
            <div class="row">
                <?php $nbre = 0?>
                <?php foreach ($pretres as $pretre) { ?>
                <div class="col-sm-6 col-md-3" style="background: white;height:390px;">
                    <div class="pastor" style="height:390px;">
                        <div class="pastor-img set-bg" data-setbg=""><img
                                src="http://ftp.stalbertlegrand-ci.net/adminStAlbert/<?=$pretre['photo_pretre']?>" alt="" width="100%"
                                height="100%"></div>
                        <h3 style="hyphens: auto;"><?= $pretre['NOM_PRETRE'].' '.$pretre['PRENOM_PRETRE'] ?></h3>
                        <p><?=$pretre['FONCTION']?></p>
                        <p><?=$pretre['contact']?></p>
                    </div>
                </div>
                <?php $nbre++ ?>
                <?php if($nbre == 4){
					$nbre = 0;
					echo '</div><br><div class="row">';
				} ?>
                <?php } ?>

            </div>
    </section>
    <!-- Pastors section end -->


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
                        document.write(new Date().getFullYear());</script> <a class="copy" href="http://softnfix.com/">SOFTN'FIX TECHNOLOGY-TOUS DROITS RÉSERVÉS.</a> <a class="admin" href="http://ftp.stalbertlegrand-ci.net/adminStAlbert/">SAINT ALBERT LE GRAND</a></p>
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