<div class="container">
    <h2>Compte Utilisateur</h2>
    <h3>Bienvenue <?php echo $user['nomC']; ?>!</h3>
    <div class="account-info">
        <p><b>Nom: </b><?php echo $user['nomC']; ?></p>
        <p><b>Prénom: </b><?php echo $user['prenomC']; ?></p>
        <p><b>Email: </b><?php echo $user['emailC']; ?></p>
        <p><b>Adresse: </b><?php echo $user['adresseC']; ?></p>
        <p><b>Abonnement: </b><?php echo $user['abonnement']; ?></p>
    </div>
    <?php echo $tab; ?>
    <a class="btn btn-primary" href="<?php echo site_url('users/logout') ?>" role="button">Se deconnecter</a>
</div>