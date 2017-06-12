<div id="accountpage" class="container">
    <div class="row col-lg-offset-4 col-lg-4">
    <h2>Compte Utilisateur</h2>
    <h3>Bienvenue <?php echo $user['nomC']; ?>!</h3>
    <div class="account-info">
        <p><b>Nom: </b><?php echo $user['nomC']; ?></p>
        <p><b>Prénom: </b><?php echo $user['prenomC']; ?></p>
        <p><b>Email: </b><?php echo $user['emailC']; ?></p>
        <p><b>Adresse: </b><?php echo $user['adresseC']; ?></p>
        <p><b>Abonnement: </b><select id="aboselect" name="genre">
                <?php foreach($abonnements as $abonnement):?>
                    <option value="<?php echo $abonnement['numAbo'];?>" <?php if ($user['abonnement'] == $abonnement['numAbo']) { echo" selected='selected'";}?>"><?php echo $abonnement['nomAbo']; ?></option>
                <?php endforeach;?>
            </select>
            <bouton class="btn btn-primary" onclick="updateProfil(<?php echo $user['numC']; ?>)" id="changeabo">Changer d'abonnement</bouton></p>
        <p class="info"></p>
    </div>
    <?php if($tab != 'Undefined table data') {echo $tab;} else { echo "pas d'historique d'emprunt";} ?>


    <br>
    <a class="btn btn-primary" id="logout" role="button">Se deconnecter</a>
    </div>
</div>
<script>



    function changeabo() {
        iduser = <?php echo $user['numC']; ?>;
        idabo= $('#aboselect').val();
        $.ajax({
            url: '/Userscontroller/updateabo',
            type: 'POST',
            data: {"idabo": idabo,"iduser": iduser},
            success: function (data) {
                aboclient = data['client'][0]['abonnement'];
                $("#aboselect").empty();
                $("#aboselect").append('<?php foreach($abonnements as $abonnement):?> <option value="<?php echo $abonnement['numAbo'];?>"><?php echo $abonnement['nomAbo']; ?></option> <?php endforeach;?>')
                $('#aboselect option[value="'+aboclient+'"]').prop('selected', true);
                $('.info').append('Abonnement mise à jour');
            },
            error: function (data) {
                console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
            }
        });
    }

</script>