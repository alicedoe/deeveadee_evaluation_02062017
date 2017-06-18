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
        <h3 class="text-center col-lg-12">Où sommes-nous ?</h3>
        <div id="map" class="col-lg-offset-3 col-lg-6"></div>
    </div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZZHZJJyA2yhVK-5Vm4qCJaAbDO6aw6fI&callback=initMap"></script>
<script>
    $( document ).ready(function() {
        initialize();

        <?php
        foreach ($magasins as $magasin) {
        $adresse = $magasin['rueS']." ".$magasin['villeS'];
        $adresse = addslashes( $adresse );
        ?>

        codeAddress('<?php echo $adresse; ?>')

        <?php
        }
        ?>
    });

    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var mapOptions = {
            zoom: 15,
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
    }

    function codeAddress(address) {
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>