<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Bienvenue chez DVD Store</title>
</head>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.2.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/script.js"); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
<link rel = "stylesheet" type = "text/css" href="<?php echo base_url("assets/css/style.css"); ?>" />
<body>
<div id="account">
    <?php
    if ( !isset($view) ) {
        if (isset($_SESSION['isUserLoggedIn'])) {
            echo "Bonjour " . $_SESSION['prenom'] . " !"; ?><br>
            <button id='logout' class='btn btn-primary'>Se deconnecter</button><br>
            <a class="btn btn-primary" href="users/account" role="button">Voir mon compte</a><?php
        } else {
            echo "
  <input type='text' name='email' placeholder='Email'><br>
  <input type='text' name='motdepasse' placeholder='Mot de passe'><br>
  <button id='login' class='btn btn-primary'>Se connecter</button><br>
  <a class='btn btn-primary' href='users/registration' role='button'>Créer un compte</a>";
        }
    }
    ?>
</div>