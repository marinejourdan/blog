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

<body class="body">
<h1>Navigation</h1>
    <div class="container">
        <div class="col-3">
         <nav>
             <ul class="nav flex-column">
                 <li class="nav-item"><a class="nav-link" href="./index.php?controller=admin&entity=post&action=displayAdminList">Posts</a></li>
                 <li class="nav-item"><a class="nav-link" href="./index.php?controller=admin&entity=user&action=displayAdminList">Users</a></li>
                 <li class="nav-item"><a class="nav-link" href="./index.php?controller=admin&entity=comment&action=displayAdminList">comments</a></li>
                 <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./index.php">Accueil</a></li>
             </ul>
         </nav>
    </div>

        <div class="col-9">
    <?php
    echo $content;
    ?>
        </div>
    </div>
</body>
