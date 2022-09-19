<?php $session = session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/assets/css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href=" -->
    <!-- base_url(esc($style)) -->
    
    <title>Home - NeoNess</title>
</head>
<body>
    <header>
        <a href="home"><img src="http://localhost/assets/images/logo.png" id="logo" alt=""></a>
    

        <?php
        if($session->logged_in == NULL) {
            ?>
            <a href="/who_are_we"><button>Who are we ?</button></a>
            <?php
        }
        ?>

        <a href="/find_us"><button>Find us</button></a>
        <a href="/contact"><button>Contact</button></a>

        <?php
        if($session->logged_in == TRUE) {
            ?>
            <a href="/create"><button>Record my activities</button></a>
            <a href="/profil"><button>profil</button></a>
            <a href="/sign_out"><button>Sign Out</button></a>
            <?php
        }
        ?>

    </header>
    <?php
    