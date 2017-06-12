<div class="container-fluid">
    <div id="welcomeMiddle" class="row col-lg-12">
        <div class="externbloc col-lg-7">
        <div class="blocmiddle center-block">
                <div>Nouveautés</div>
            <?php for ($i=1; $i<5; $i++) {
                                                ?>
                                                <div class="col-lg-3 jaquette">
                                                    <img height="200px" src="/assets/img/jaquette<?php echo $i; ?>.jpg" alt="">
                                                </div>
                                            <?php } ?>

        </div>
        </div>
        <div class="externbloc col-lg-4 ">
        <div class="blocmiddle center-block">
                <div>Top DVD</div>
                <?php foreach ($moyennes as $dvd) {
                    ?>
                    <div><?php echo $dvd["titreD"]; ?></div>
                <?php } ?>

        </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div id="abo" class="row col-lg-12">
        <div class="col-lg-4 center-block">
            <div class="blocAbo">
                <div>Formule TopCool</div>
                <div>10€ par mois</div>
                <div>5 DVD</div>
            </div>
        </div>
        <div class="col-lg-4 center-block">
            <div class="blocAbo">
                <div>Formule SuperCool</div>
                <div>20€ par mois</div>
                <div>15 DVD</div>
            </div>
        </div>
        <div class="col-lg-4 center-block">
            <div class="blocAbo">
                <div>Formule MegaCool</div>
                <div>30€ par mois</div>
                <div>DVD illimités</div>
            </div>
        </div>
    </div>
</div>