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

$query = $connexion->query('select * from articles');
if ($query){
$articles = $query->fetchAll();
} else{
    $articles = null;
}
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);

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
    <title>St Albert le grand - Blog</title>
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
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="css/style.css" />


    <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- header top section -->
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
                    <li><a href="event.php">Informations</a></li>
                    <li class="active"><a href="blog.php">blog</a></li class="active">
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
                    <h2>Blog</h2>
                    <div class="site-breadcrumb">
                        <a href="#">Accueil</a> <i class="fa fa-angle-right"></i>
                        <span>Blog</span>
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


    <!-- Blog section -->
    <section class="blog-section blog-page spad">
        <div class="container">
            <div class="section-title">
                <span>Blog de l'eglise</span>
                <h2>Dernieres Nouvelles</h2>
            </div>
            <div class="row">
                <?php foreach ($articles as $article){ ?>
                <div class="col-sm-4">
                    <div class="blog-item">
                        <div class="bi-thumb set-bg"><img
                                src="http://ftp.stalbertlegrand-ci.net/adminStAlbert/<?=$article['IMAGE_ARTICLE']?>" alt=""
                                height="250px" width="360px"></div>
                        <div class="bi-content">
                            <div class="date">
                                <?= strftime('%A %d %B %Y, %I:%M',strtotime($article['DATE_PUBLICATION']))?></div>
                            <h4><a
                                    href="single-blog.php?article=<?=$article['ID_ARTICLE']?>"><?=$article['TITRE_ARTICLE']?></a>
                            </h4>
                            <a href="single-blog.php?article=<?=$article['ID_ARTICLE']?>" class="bi-cata">Lire plus</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Blog section end-->


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
                        </script> <a class="copy" href="http://softnfix.com/">SOFTN'FIX TECHNOLOGY-TOUS DROITS RÉSERVÉS.</a><a class="admin" href="http://ftp.stalbertlegrand-ci.net/adminStAlbert/">SAINT ALBERT LE GRAND</a></p>
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