<script type="text/javascript" src="<?php echo base_url("assets/js/catalogue.js"); ?>"></script>

        <div class="container">
<!--            <select id="genre" class="form-control col-lg-6" name="genre">-->
<!--                <option value="*" selected="selected">Toutes les catégories</option>-->
<!--            --><?php //foreach($genres as $genre):?>
<!--                <option value="--><?php //echo $genre['numG']; ?><!--">--><?php //echo $genre['nomG']; ?><!--</option>-->
<!--            --><?php //endforeach;?>
<!--            </select>-->
<!--            <div id="catalogue" class="row">-->
<!--                --><?php //echo $tab; ?>
<!--            </div>-->
<!--        </div>-->
<!--        <div id="detail">-->
<!---->
<!--        </div>-->
<!--        <div id="moyenne">-->
<!--        </div>-->
<!--        --><?php //if(isset($_SESSION['numC'])) {
//            echo "<div id='note'></div>"; } ?>
<!--        <div id="remarques"></div>-->
<!--        --><?php //if(isset($_SESSION['numC'])) {
//        echo "<div id='saisiremarque'></div>"; } ?>

                <div class="container col-lg-12">
                    <?php foreach($dvds as $dvd): ?>
                    <div class="extbloccata col-lg-6">
                    <div class="bloccata">
                        <div class="bloccatag col-lg-4">
                            <img src="/assets/img/jaquette1.jpg" alt="jaquette">
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