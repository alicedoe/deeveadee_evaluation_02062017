<!--<div class="container">-->
<!--    <h2>User Registration</h2>-->
<!--    <form action="" method="post">-->
<!--        <div class="form-group">-->
<!--            <input type="text" class="form-control" name="nomC" placeholder="Nom" required="" value="--><?php //echo !empty($user['nomC'])?$user['nomC']:''; ?><!--">-->
<!--            --><?php //echo form_error('nomC','<span class="help-block">','</span>'); ?>
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <input type="text" class="form-control" name="prenomC" placeholder="Prénom" required="" value="--><?php //echo !empty($user['prenomC'])?$user['prenomC']:''; ?><!--">-->
<!--            --><?php //echo form_error('prenomC','<span class="help-block">','</span>'); ?>
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <input type="text" class="form-control" name="adresseC" placeholder="Adresse" required="" value="--><?php //echo !empty($user['adresseC'])?$user['adresseC']:''; ?><!--">-->
<!--            --><?php //echo form_error('adresseC','<span class="help-block">','</span>'); ?>
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <input type="email" class="form-control" name="emailC" placeholder="Email" required="" value="--><?php //echo !empty($user['emailC'])?$user['emailC']:''; ?><!--">-->
<!--            --><?php //echo form_error('emailC','<span class="help-block">','</span>'); ?>
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <input type="password" class="form-control" name="motdepasseC" placeholder="Mot de passe" required="">-->
<!--            --><?php //echo form_error('motdepasseC','<span class="help-block">','</span>'); ?>
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <input type="submit" name="regisSubmit" onclick="registration()" class="btn-primary" value="Submit"/>-->
<!--        </div>-->
<!--    </form>-->
<!--</div>-->

<form action="" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="nomC" placeholder="Nom" required="" value="<?php echo !empty($user['nomC'])?$user['nomC']:''; ?>">
        <?php echo form_error('nomC','<span class="help-block">','</span>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="prenomC" placeholder="Prénom" required="" value="<?php echo !empty($user['prenomC'])?$user['prenomC']:''; ?>">
        <?php echo form_error('prenomC','<span class="help-block">','</span>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="adresseC" placeholder="Adresse" required="" value="<?php echo !empty($user['adresseC'])?$user['adresseC']:''; ?>">
        <?php echo form_error('adresseC','<span class="help-block">','</span>'); ?>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="emailC" placeholder="Email" required="" value="<?php echo !empty($user['emailC'])?$user['emailC']:''; ?>">
        <?php echo form_error('emailC','<span class="help-block">','</span>'); ?>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="motdepasseC" placeholder="Mot de passe" required="">
        <?php echo form_error('motdepasseC','<span class="help-block">','</span>'); ?>
    </div>
    <div class="form-group">
        <input type="submit" name="regisSubmit" onclick="registration()" class="btn-primary" value="Submit"/>
    </div>
</form>