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

<div id="header" class="container-fluid">
    <div id="header" class="row col-lg-12">
        <div id="logo" class="col-lg-3">
            <img src="<?php echo base_url("assets/img/logo.png"); ?>" alt="logoDvdStore">
        </div>
        <div id="middle" class="col-lg-6">
            <span class="col-lg-2 headerInline imgsearchB"><a href='/'><img role="button" src="<?php echo base_url("assets/img/home.png"); ?>" alt="accueil"></a></span>
            <div id = "searchBar" sautocomplete="off" class="col-lg-8 form-horizontal" method="post" accept-charset="utf-8">
                <div class="input-group">
                    <input name="searchtext" value="" class="form-control" type="text">
                    <span class="input-group-btn">
               <button class="btn btn-default" type="submit" id="addressSearch">
                   <span class="glyphicon glyphicon-search"></span>
               </button>
            </span>
                </div>
            </div>

            <span class="col-lg-2 headerInline imgsearchB"><a href='/'><img role="button" src="<?php echo base_url("assets/img/cart.png"); ?>" alt="panier"></a></span>
        </div>
        <div id="blocUser" class="col-lg-3">
            <?php if($this->session->userdata('isUserLoggedIn')) {
                echo "<div class='middlehor text-center' id='btnAccount'>
                        <div class='col-lg-12'>Bonjour ".$this->session->userdata('prenom')." !</div>
                        <div><a href='users/account'><button class='col-lg-12 btn btn-primary'>Mon compte</button></a></div>
                        <button id='logout' class='col-lg-12 middlehor btn btn-primary'>Se deconnecter</button>
                      </div>";
            } else { ?> <div class="middlehor login">
                <button data-toggle="modal" data-target="#popinLogin" class="col-lg-12 btn btn-sm btn-primary connect">Se connecter</button>
                <button data-toggle="modal" data-target="#popinCreateAccount" class="col-lg-12 btn btn-sm btn-primary register">Créer un compte</button>
            </div> <?php } ?>

        </div>
    </div>
</div>

<div class="modal fade in" id="popinLogin" role="dialog" aria-hidden="false">
    <div  class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span><span class="sr-only">Fermer</span>
            </button>
            <h2 class="modal-title">Se connecter</h2>
        </div>
        <div class="modal-body loginForm">
            <div class="error"></div>
            <div class="loginInfo">
                <div class="form-group username">
                    <label class="control-label" for="login_username">Adresse Email</label>
                    <input id="login_username" autocomplete="off" type="login" class="form-control" name="login_username" placeholder="Adresse Email" type="email">
                    <span class="help-block"></span>
                </div>
                <div class="form-group password">
                    <label class="control-label" for="login_password">Mot de passe</label>
                    <input id="login_password" autocomplete="off" type="password" class="form-control" name="login_password" placeholder="Mot de passe">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button id='login' class='btn btn-primary btn-login'>Se connecter</button>
                    </div>
                </div>
                <input type="hidden" name="redirectUrl" value="">
            </div>
        </div>
        <div class="modal-footer">
            <p>
                Vous n'avez pas de compte ? <a class="signupModal" role="button" data-dismiss="modal" data-toggle="modal" data-target="#popinCreateAccount">créez en un ici</a>
            </p>
        </div>
    </div>
</div>

<div class="modal fade in" id="popinCreateAccount" role="dialog" aria-hidden="false">
    <div  class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span><span class="sr-only">Fermer</span>
            </button>
            <h2 class="modal-title">Créer un compte</h2>
        </div>
        <div class="modal-body loginForm">
            <div class="error"></div>
            <div class="loginInfo">
                <form id="formRegistration" action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" autocomplete="off" name="nomC" placeholder="Nom" required="" value="<?php echo !empty($user['nomC'])?$user['nomC']:''; ?>">
                        <?php echo form_error('nomC','<span class="help-block">','</span>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" autocomplete="off" name="prenomC" placeholder="Prénom" required="" value="<?php echo !empty($user['prenomC'])?$user['prenomC']:''; ?>">
                        <?php echo form_error('prenomC','<span class="help-block">','</span>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" autocomplete="off" name="adresseC" placeholder="Adresse" required="" value="<?php echo !empty($user['adresseC'])?$user['adresseC']:''; ?>">
                        <?php echo form_error('adresseC','<span class="help-block">','</span>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" autocomplete="off" name="emailC" placeholder="Adresse Email" required="" value="<?php echo !empty($user['emailC'])?$user['emailC']:''; ?>">
                        <?php echo form_error('emailC','<span class="help-block">','</span>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" autocomplete="off" name="motdepasseC" placeholder="Mot de passe" required="">
                        <?php echo form_error('motdepasseC','<span class="help-block">','</span>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <button id='registration' class="btn btn-primary btn-login">Créer le compte</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<nav class="navbar navbar-default">
    <div id="menu" class="container-fluid col-lg-12">
        <div class="col-lg-3">
            <a href="/abonnements">
                Les abonnements
            </a>
        </div>
        <div class="col-lg-3">
            <a href="/catalogue/page/1">
                Le catalogue
            </a>
        </div>
        <div class="col-lg-3">
            <a href="/magasins">
                Nos magasins
            </a>
        </div>
        <div class="col-lg-3">
            <a href="/contact">
                Nous contacter
            </a>
        </div>
    </div>
</nav>
