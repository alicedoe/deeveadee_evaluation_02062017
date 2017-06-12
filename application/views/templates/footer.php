<div class="footer container-fluid">
    <div class="col-lg-4" id="reseaux">
        <div class="col-lg-4" >
        <img src="<?php echo base_url("assets/img/facebook.png"); ?>" alt="facebook">
        </div>
        <div class="col-lg-4" >
        <img src="<?php echo base_url("assets/img/google+.png"); ?>" alt="google">
        </div>
        <div class="col-lg-4" >
        <img src="<?php echo base_url("assets/img/twitter.png"); ?>" alt="twitter">
        </div>
    </div>
    <div class="col-lg-8" id="footerText">
        <span>Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </span>
        </div>

</div>
</body>
</html>