<script type="text/javascript" src="<?php echo base_url("assets/js/catalogue.js"); ?>"></script>
<script>
    $( document ).ready(function() {
        if ( "<?php echo $idgenre; ?>" == "all") {
        $('#tousgenres').removeClass('btngenre').addClass('redborder');
        } else {
            $("#genre-<?php echo $idgenre; ?>").removeClass('btngenre').addClass('redborder');
            console.log($("#tousgenres"));
        }
    })
</script>
<div class="container">
    <div class="container-fluid col-lg-12 genre">
        <?php foreach($genres as $genre): ?>

            <span class="col-lg-3"><a href="/catalogue/genre/<?php echo $genre['numG']; ?>/1"><button id="genre-<?php echo $genre['numG']; ?>" class="btn btngenre"><?php echo $genre['nomG']; ?></button></a></span>

        <?php endforeach; ?>
        <span class="col-lg-3"><a href="/catalogue/genre/all/1"><button id="tousgenres" class="btn btngenre">Tous les genres</button></span>
    </div>
</div>

<div class="container">
    <div class="container-fluid col-lg-12">
        <?php foreach($dvds as $dvd):
            ?>
            <div class="extbloccata col-lg-4">
                <div class="bloccata">
                    <div class="bloccatag col-lg-4">
                        <img src="https://unsplash.it/75/100/?random" alt="jaquette">
                    </div>
                    <div class="bloccatad col-lg-8">
                        <span><?php echo "Titre : ".$dvd['titreD']; ?></span>
                        <span><?php echo "Genre : ".$dvd['nomG']; ?></span>
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