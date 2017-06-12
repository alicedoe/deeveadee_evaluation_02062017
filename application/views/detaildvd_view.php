<script type="text/javascript" src="<?php echo base_url("assets/js/catalogue.js"); ?>"></script>
<div class="container-fluid">
    <div class="row col-lg-12">
            <div class="detaildvd col-lg-offset-3 col-lg-6">
                <div class="col-lg-12"><?php echo $dvd[0]['titreD']; ?></div>
                <div class="col-lg-6">
                    <img src="/assets/img/jaquette1.jpg" alt="jaquette">
                </div>

                <div class="col-lg-6">
                    <div><?php echo "Auteur : ".$dvd[0]['auteurD']; ?></div>
                    <div><?php echo "Date de sortie : ".$dvd[0]['anneeD']; ?></div>
                    <div><?php echo "Genre : ".$dvd[0]['nomG']; ?></div>
                    <div><?php echo "Exemplaire(s) restant(s) : ".$dvd[0]['nombreD']; ?></div>
                    <div><?php echo "Consultations : ".$dvd[0]['consultationsD']; ?></div>
                    <div><?php echo "En stock chez : ".$dvd[0]['nomS']; ?></div>
                    <div><?php if (isset($moyenne)) {for ($i=0; $i < $moyenne; $i++) {
                        echo "<i class='glyphicon glyphicon-star'></i>";
} } else { for ($i=0; $i < 5; $i++) {
                            echo "<i class='glyphicon glyphicon-star-empty'></i>";
                        } } ?></div>
                    <div><?php if (isset($anote)) { echo "Vous avez déjà noté ce DVD ou vous n'êtes pas connecté"; } else { echo "truc pour voter"; }?></div>
                </div>
                <div class="col-lg-12" id="remarques">
                    <div>Commentaires sur le film :</div>
                <?php foreach ($listeremarques as $remarque) {
                    echo "<div class=\"col-lg-12\">".$remarque['commentairesR']."</div>";
                    } ?>

                </div>
                <div><?php if ($isUserLoggedIn) {
                        echo '<input id="commentaire" class="form-control" placeholder="Votre commentaire" type="text">';
                        echo '<button class="btn btn-primary col-lg-offset-3 col-lg-6" onclick="addremarque('.$dvd[0]['numD'].')"  id="submitcommentaire">Envoyer</button>';
                    } else { echo "Veuillez vous connectez pour laisser un commentaire"; }?></div>
            </div>
    </div>
</div>