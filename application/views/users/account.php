<div class="container">
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
            <bouton class="btn btn-primary" id="changeabo">Changer d'abonnement</bouton></p>
    </div>
    <?php if(count($tab) > 1) {echo $tab;} else { echo "pas d'historique d'emprunt";} ?>


    <br>
    <a class="btn btn-primary" href="<?php echo site_url('users/logout') ?>" role="button">Se deconnecter</a>
</div>
<script>

            $('#changeabo').click(function(){ changeabo()});

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
            },
            error: function (data) {
                console.log("erreuuuuuuuuuuuuuuuuur" + data.toString());
            }
        });
    }

</script>