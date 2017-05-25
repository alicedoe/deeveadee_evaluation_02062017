<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Bienvenue chez DVD Store</title>
</head>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.2.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
<style>
    .glyphicon-lg
    {
        font-size:4em
    }
    .info-block
    {
        border-right:5px solid #E6E6E6;margin-bottom:25px
    }
    .info-block .square-box
    {
        width:100px;min-height:110px;margin-right:22px;text-align:center!important;background-color:#676767;padding:20px 0
    }
    .info-block.block-info
    {
        border-color:#20819e
    }
    .info-block.block-info .square-box
    {
        background-color:#20819e;color:#FFF
    }
</style>
<body>

<div id="container">
    <?php echo base_url("assets/js/jQuery-1.10.2.js"); ?>
    <h1>Bienvenue chez DVD Store</h1>

    <div id="body">
        <div class="container">

            <p>Présentation des activités de la société :</p>

            <p>Nouveautés reçues dans le mois :</p>

            <p>Nos offres d'abonnements</p>

            <p>Nos magasins :</p>
            <div class="row"><?php foreach ($societes as $societe) { ?>
                    <div class="items col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">

                        <div class="info-block block-info clearfix">
                            <div class="square-box pull-left">
                                <span class="glyphicon glyphicon-home glyphicon-lg"></span>
                            </div>
                            <h5><?php echo $societe["nomS"]; ?></h5>
                            <h4>Adresse : <?php echo $societe["rueS"]; ?></h4>
                            <h4>Ville : <?php echo $societe["villeS"]; ?></h4>
                            <p>Directeur: <?php echo $societe["directeurS"]; ?></p>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>

        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
    </div>
</div>
</body>
</html>