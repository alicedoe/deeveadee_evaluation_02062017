<div class="container-fluid">
    <div id="abo" class="row col-lg-12">

        <?php foreach ($magasins as $magasin) {
            ?>
            <div class="col-lg-6 center-block">
                <div class="blocAbo">
                    <div><?php echo $magasin['nomS']; ?></div>
                    <div><?php echo "Adresse : ".$magasin['rueS']; ?></div>
                    <div><?php echo "Ville : ".$magasin['villeS']; ?></div>
                    <div><?php echo "Directeur : ".$magasin['directeurS']; ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>