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
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Days+One" />
</head>

<body>
    <nav id="mainNav" class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="./index.php">Retour à l'accueil</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Retour à l'accueil du site
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link " href="./index.php?controller=admin&entity=post&action=displayAdminList">Posts</a></li>
                    <li class="nav-item"><a class="nav-link " href="./index.php?controller=admin&entity=user&action=displayAdminList">Utilisateurs</a></li>
                    <li class="nav-item"><a class="nav-link " href="./index.php?controller=admin&entity=comment&action=displayAdminList">Commentaires</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container">

            <div class="col-8">
                    <!-- Masthead Heading-->
                <h3 class="masthead-heading text-uppercase mb0">Administration</h3>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>

        </div>
    </header>

    <div class="container">
    <?php
    echo $content;
    ?>
    </div>
</body>
