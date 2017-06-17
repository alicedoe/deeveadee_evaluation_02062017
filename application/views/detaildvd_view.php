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
                    <div id="reste"><?php echo "Exemplaire(s) restant(s) : ".$dvd[0]['nombreD']; ?></div>
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
                    <div><?php if ( isset($anote) && $anote > 0) { echo "Vous avez déjà noté ce DVD"; } elseif (!$isUserLoggedIn) { echo "Vous devez être connecté pour noter";} else { ?>
<span class="col-lg-4">Votre vote </span> <ul class="pagination class="col-lg-8"">

                                <li onclick="note(1,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>1</a></li>
                                <li onclick="note(2,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>2</a></li>
                                <li onclick="note(3,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>3</a></li>
                                <li onclick="note(4,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>4</a></li>
                                <li onclick="note(5,<?php echo $dvd[0]['numD'] ?>)" role="button"><a>5</a></li>
                            </ul>
                        <?php }?></div>
                    <div class="fb-share-button" data-href="<?php echo base_url(); ?>/catalogue/<?php echo $dvd[0]['numD']; ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Partager</a></div>
                    <?php if ($isUserLoggedIn) { ?> <div class="text-center"><button data-toggle="modal"  data-target="#emprunt" class="btn-lg btn-primary">Reserver</button></div> <?php } else { echo "Vous devez être connecté pour reserver"; } ?>
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


<div class="modal fade in" id="emprunt" role="dialog" aria-hidden="false">
    <div  class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span><span class="sr-only">Fermer</span>
            </button>
            <h2 class="modal-title">Emprunter un DVD</h2>
        </div>
        <div class="modal-body loginForm">
            <div class="error"></div>
            <div class="loginInfo">
                <?php if ($dvd[0]['nombreD'] == 0) {
                ?> <div id ="dureefield" class="form-group">
                    <span>Il ne reste plus aucun exemplaire de ce dvd</span>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">Fermer</span>
                        </button>
                </div> <?php
                } else { ?>
                <div id ="dureefield" class="form-group">
                    <span>Veuillez saisir la durée de l'emprunt entre 1 & 60 jours :</span>
                    <input type="text" class="form-control" autocomplete="off" id="empruntduree" placeholder="durée" required="">
                    <div class="error"></div>
                </div>
                <div class="form-group">
                    <span>DVD disponible chez : <?php echo $dvd[0]['nomS'] ?></span>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button id='registration' onclick="emprunt(<?php echo $dvd[0]['numD'] ?>,<?php echo $numc ?>)" class="btn btn-primary btn-login">Réserver</button>
                    </div>
                </div> <?php } ?>
            </div>
        </div>
    </div>
</div>