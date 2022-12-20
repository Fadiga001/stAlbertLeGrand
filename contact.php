<?php
header("Content-Type: text/html; charset=utf-8"); 
try {
	$connexion = new PDO('mysql:host=91.216.107.185;dbname=stalb1938159;charset=utf8','stalb1938159','i2ecgu8sh4');
    $connexion->exec('SET NAMES utf8');
} catch (Exception $e) {
	die($e);
}

$query = $connexion->query('select * from ncontact where id_contact = (select max(id_contact) from ncontact)');
if ($query){
$contact = $query->fetch();
} else{
    $contact = null;
}
    if (isset($_POST['envoyer'])){

        date_default_timezone_set('UTC');

        $nom=$_POST['nom'];
        $contact=$_POST['contact'];
        $message=$_POST['message'];
        $date_envoi = date('Y/m/d H:i');
        $query = $connexion->prepare('insert into contact(NOM, E_MAIL, CONTENU_MESSAGE, date_envoi) values (?,?,?,?)');
        $execution = $query->execute(array($nom,$contact,$message,$date_envoi));
        if ($execution){
            $message_sent = true;
        } else{
            $message_sent = false;
        }
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
    <title>St Albert le grand - Contacts</title>
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

<body class="contact">
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
                    <li><a href="blog.php">blog</a></li>
                    <li><a href="galerie.php">Galerie</a></li>
                    <li class="active"><a href="contact.php">Contacts</a></li class="active">
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
                    <h2>CONTACT</h2>
                    <div class="site-breadcrumb">
                        <a href="#">Accueil</a> <i class="fa fa-angle-right"></i>
                        <span>Contacts</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page info section end -->
    <div class="event-section">
        <div class="container">
            <div class="row"></div>
        </div>
    </div>


    <!-- Google map -->
    <div class="full-map"><iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3972.448773367355!2d-3.993921!3d5.348266!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1eb7ba68b2a4f%3A0xe90f85d2af5d3354!2sEglise%20Catholique%20ST%20ALBERT%20LE%20GRAND!5e0!3m2!1sfr!2sus!4v1605056053884!5m2!1sfr!2sus"
            width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe></div>


    <!-- Footer top section -->
    <section class="footer-top-contact-section spad footer">
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
                <div class="col-md-6">
                    <div class="section-title title-left">
                        <h2>CONTACTEZ-NOUS</h2>
                    </div>
                    <form class="contact-form" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" placeholder="Nom" name="nom" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" placeholder="Email ou téléphone" name="contact" required>
                            </div>
                            <div class="col-sm-12">
                                <textarea placeholder="Message" name="message" required></textarea>
                                <button type="submit" class="site-btn" name="envoyer">Envoyer message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer top section end-->


    <!-- Newsletter section -->
    <!-- Newsletter section end-->


    <!-- Footer section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="copyright">
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
    <script src="js/jquery.countdown.js"></script>
    <script src="js/main.js"></script>

    <!-- load for map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0YyDTa0qqOjIerob2VTIwo_XVMhrruxo"></script>
    <script src="js/map.js"></script>
    <script src="js/bootstrap-notify.js"></script>
    <script type="text/javaScript">
        <?php  if ($message_sent) { $test = $message_sent; } ?>
        var test = <?=json_encode($test); ?>;
        //alert(test);

        if( test == true ){
            $.notify({
                icon:'fa fa-check-circle',
                message:'Message envoyé'
            },{
                type:'success',
                offset: {
                    x:0,
                    y:20
                },
                placement: {
                    from :'top',
                    align: 'right'
                },
                delay: 2000
            })
        } else{
            $.notify({
                icon:'fa fa-exclamation-circle',
                message:'Message non envoyé veullez réessayer'
            },{
                type:'danger',
                offset: {
                    x:0,
                    y:20
                },
                placement: {
                    from :'top',
                    align : 'right'
                },
                delay: 2000
            })
        }
    </script>
</body>

</html>