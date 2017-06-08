<script type="text/javascript" src="<?php echo base_url("assets/js/catalogue.js"); ?>"></script>
<div id="body">
    <div class="container">
        <div class="jumbotron">
            <h1>Bienvenue chez DVD Store</h1>
            <p>Quelle que soit la dualité de la situation contemporaine, on ne peut se passer de prendre en considération chacune des voies de bon sens. Avec la conjoncture contemporaine, il serait bon d'imaginer toutes les voies s'offrant à nous. Quelle que soit la situation qui est la nôtre, on ne peut se passer de prendre en considération la totalité des problématiques déjà en notre possession.</p>
            <p><a class="btn btn-primary btn-lg" href="/" role="button">Accueil</a></p>
        </div>
        <div class="container">
            <select id="genre" name="genre">
                <option value="*" selected="selected">Toutes les catégories</option>
            <?php foreach($genres as $genre):?>
                <option value="<?php echo $genre['numG']; ?>"><?php echo $genre['nomG']; ?></option>
            <?php endforeach;?>
            </select>
            <div id="catalogue" class="row">
                <?php echo $tab; ?>
            </div>
        </div>
        <div id="detail">

        </div>
        <div id="moyenne">
        </div>
        <div id="note"></div>
        <div id="remarques"></div>
        <div id="saisiremarque"></div>
    </div>
</div>

<script type="text/javascript">

</script>