<div id="body">
        <div class="page-header">
            <h1>Nos 6 dernières nouveautées :</h1>
        </div>
        <div class="row">
            <ul class="list-group">
                <?php foreach ($lastDvd as $dvd) {
                    ?>
                    <li class="list-group-item col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <span class="badge"><?php echo $dvd["nombreD"]; ?></span>
                        <?php echo $dvd["titreD"]." - ".$dvd["nomG"]." - ".$dvd["dateAchatD"]; ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="page-header">
            <h1>Nos offres d'abonnements :</h1>
        </div>

        <div class="page-header">
            <h1>Nos magasins :</h1>
        </div>
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
</div>