<div id="accountpage" class="container">
    <div class="row col-lg-offset-4 col-lg-4">
    <h2>Compte Utilisateur</h2>
    <h3>Bienvenue <?php echo $user['nomC']; ?>!</h3>
    <div class="account-info">
        <p><b>Nom: </b><input id="nomC" class="form-control" type="text" value="<?php echo $user['nomC']; ?>"></p>
        <p><b>Prénom: </b><input id="prenomC" class="form-control" type="text" value="<?php echo $user['prenomC']; ?>"></p>
        <p><b>Email: </b><input id="emailC" class="form-control" type="text" value="<?php echo $user['emailC']; ?>"></p>
        <p><b>Mot de passe: </b><input id="motdepasseC" class="form-control" type="text" value="<?php echo $user['motdepasseC']; ?>"></p>
        <p><b>Adresse: </b><input id="adresseC" class="form-control" type="text" value="<?php echo $user['adresseC']; ?>"></p>
        <p><b>Abonnement: </b><select class="form-control" id="aboselect" name="genre">
                <?php foreach($abonnements as $abonnement):?>
                    <option value="<?php echo $abonnement['numAbo'];?>" <?php if ($user['abonnement'] == $abonnement['numAbo']) { echo" selected='selected'";}?>"><?php echo $abonnement['nomAbo']; ?></option>
                <?php endforeach;?>
            </select>
            <bouton class="btn btn-primary" onclick="updateProfil(<?php echo $user['numC']; ?>)" id="changeabo">Valider les modifications</bouton></p>
        <p class="info"></p>
    </div>
    <?php if($tab != 'Undefined table data') {echo $tab;} else { echo "pas d'historique d'emprunt";} ?>


    <br>
    <a class="btn btn-primary" id="logout" role="button">Se deconnecter</a>
    </div>
</div>