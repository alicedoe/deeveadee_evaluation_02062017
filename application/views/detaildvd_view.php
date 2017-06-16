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
                    <div><?php
                        if (isset($moyenne)) {
                            $etoilesvides = 5 - $moyenne;
                            for ($i=0; $i < $moyenne; $i++) {
                                echo "<i class='glyphicon glyphicon-star'></i>";
                                if ($moyenne === 5 && $i == 4) {
                                    echo " : ".$totalnotes." vote(s)";
                                }
                            }
                            for ($i=0; $i < $etoilesvides; $i++) {
                                echo "<i class='glyphicon glyphicon-star-empty'></i>";
                                if ($i == ($etoilesvides-1)) {echo " : ".$totalnotes." vote(s)";}
                            }
                        } else { for ($i=0; $i < 5; $i++) {
                            echo "<i class='glyphicon glyphicon-star-empty'></i>";
                        } echo " : 0 vote"; } ?></div>
                    <div><?php if ( $anote > 0) { echo "Vous avez déjà noté ce DVD"; } elseif (!$isUserLoggedIn) { echo "Vous devez être connecté pour noter";} else { ?>
Votre vote <ul class="pagination">

                                <li onclick="note(1,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>1</a></li>
                                <li onclick="note(2,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>2</a></li>
                                <li onclick="note(3,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>3</a></li>
                                <li onclick="note(4,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>4</a></li>
                                <li onclick="note(5,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>5</a></li>
                            </ul>
                        <?php }?></div>
                    <div class="fb-share-button" data-href="<?php echo base_url(); ?>/catalogue/<?php echo $dvd[0]['numD']; ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Partager</a></div>
                    <div class="text-center"><button class="btn-lg btn-primary">Reserver</button></div>
                    </div>
                <div class="col-lg-12" id="remarques">
                    <div>Commentaires sur le film :</div>
                    <?php if (count($listeremarques) == 0 ) {
                        echo "<div class='col-lg-12' id='noremarque'> Aucun commentaire </div>";
                    }
                 foreach ($listeremarques as $remarque) {
                    echo "<div class=\"col-lg-12\">".$remarque['prenomC']." : ".$remarque['commentairesR']."</div>";
                    }
//                    '.$dvd[0]['numD'].','.$numc.','.$prenom.'
                    ?>


                <?php if ($isUserLoggedIn) {
                        echo '<input id="commentaire" class="form-control" placeholder="Votre commentaire" type="text">';
                        echo '<button class="btn btn-primary col-lg-offset-3 col-lg-6" onclick="addremarque('.$dvd[0]['numD'].','.$numc.')"  id="submitcommentaire">Envoyer</button></div>';
                    } else { ?> <div>Veuillez vous connectez pour laisser un commentaire </div> <?php }?>
                </div>
                </div>

    </div>
</div>