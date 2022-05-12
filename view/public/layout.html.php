<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home-page Marine Jourdan-Freelancer</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/home.css" rel="stylesheet" />

    </head>


    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="assets/img/portfolio/CV.pdf">Mon CV</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Mon CV
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./index.php">Accueil</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./index.php?controller=post&action=displayList">Mon blog</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./index.php?controller=user&action=displayRegister">inscription
                        </a></li>

                        <?php if(isset($_SESSION['email'])){?>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./index.php?controller=user&action=doLogout">Logout</a></li>

                        <?php }else{?>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./index.php?controller=user&action=displayLogin">Login</a></li>

                        <?php }?>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href= "#contact-form">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>




<!-- <body id="content">
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container">
            <div class="col-6">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-5" src="assets/img/portfolio/profile.jpeg" alt="..." />
            </div>

            <div class="col-6">
                    <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">Marine Jourdan</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">Freelance-développeuse PHP</p>
            </div>
        </div> -->
    </header>

    <div class="container">

            <body class="body">
                <div class="col-10">
                    <?php
                    echo $content;
                    ?>
                </div>
                <div class="col-2">
                    <img class="masthead-avatar mb-5" src="assets/img/portfolio/dame4.jpg">
                </div>
            </body>

    </div>
    <!--Section: Contact v.2-->
    <div class="contact_form">
        <section class="mb-4">

            <!--Section heading-->
            <h2 class="h1-responsive font-weight-bold text-center my-4">Contactez-moi</h2>

            <div class="row">

                <!--Grid column-->
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="./index.php?controller=home&action=doSendEmail" method="POST">

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="name" class="">Votre nom</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="email" class="">Votre mail</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="">Sujet du mail</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form">
                                    <label for="message">Votre message</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->

                    </form>

                    <div class="text-center text-md-left">
                        <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Envoyer</a>
                    </div>
                    <div class="status"></div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-map-marker-alt fa-2x"></i>
                            <p>10 rue Augustin Mouillé 44400 REZE</p>
                        </li>

                        <li><i class="fas fa-phone mt-4 fa-2x"></i>
                            <p>+ 33 7 69 12 22 30</p>
                        </li>

                        <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                            <p>marine.misser@gmail.com</p>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

            </div>
        </section>

    <!--Section: Contact v.2-->

    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Mon adresse</h4>
                    <p class="lead mb-0">
                        10 rue Augustin Mouillé
                        <br />
                        44400 REZE
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Mes réseaux sociaux</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://www.facebook.com/marinemisser"><i class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://fr.linkedin.com/in/marine-misser-235738220"><i class="fab fa-fw fa-linkedin-in"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">acces admin </h4>
                    <p class="lead mb-0">
                        Acces à l'admin réservé aux administrateurs du site
                        <a href="./index.php?controller=user&action=accessAdmin">Accès admin</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>