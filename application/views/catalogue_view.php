<script type="text/javascript" src="<?php echo base_url("assets/js/catalogue.js"); ?>"></script>

        <div class="container">
            <select id="genre" class="form-control col-lg-6" name="genre">
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
        <?php if(isset($_SESSION['numC'])) {
            echo "<div id='note'></div>"; } ?>
        <div id="remarques"></div>
        <?php if(isset($_SESSION['numC'])) {
        echo "<div id='saisiremarque'></div>"; } ?>
    </div>