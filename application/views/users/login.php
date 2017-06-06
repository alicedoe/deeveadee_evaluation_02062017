<div class="container">
    <h2>User Login</h2>
    <?php
    if(!empty($success_msg)){
        echo '<p class="statusMsg">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="statusMsg">'.$error_msg.'</p>';
    }
    ?>
    <form action="" method="post">
        <div class="form-group has-feedback">
            <input type="email" class="form-control" name="emailC" placeholder="Email" required="" value="">
            <?php echo form_error('emailC','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="motdepasseC" placeholder="Password" required="">
            <?php echo form_error('motdepasseC','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="submit" name="loginSubmit" class="btn-primary" value="Submit"/>
        </div>
    </form>
</div>