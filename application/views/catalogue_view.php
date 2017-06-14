<script type="text/javascript" src="<?php echo base_url("assets/js/catalogue.js"); ?>"></script>

        <div class="container">
                <div class="container col-lg-12">
                    <?php foreach($dvds as $dvd): ?>
                    <div class="extbloccata col-lg-6">
                    <div class="bloccata">
                        <div class="bloccatag col-lg-4">
                            <img src="https://unsplash.it/75/100/?random" alt="jaquette">
                        </div>
                        <div class="bloccatad col-lg-8">
                            <span><?php echo "Titre : ".$dvd['titreD']; ?></span>
                            <span><?php echo "Date de sortie : ".$dvd['anneeD']; ?></span>
                            <span><?php echo "Quantité : ".$dvd['nombreD']; ?></span>
                            <span><a href="/catalogue/<?php echo $dvd['numD']; ?>"><button class="btn btn-primary">Détails</button></a></span>
                        </div>
                    </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php
            echo $pagination;
            ?>
    </div>