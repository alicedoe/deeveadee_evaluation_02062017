<!--<!--<div class="container-fluid">-->
<!--<!--    <div id="abo" class="row col-lg-12">-->
<!--<!---->
<!--<!--        -->--><?php ////foreach ($magasins as $magasin) {
////            ?>
<!--<!--            <div class="col-lg-6 center-block">-->
<!--<!--                <div class="blocAbo">-->
<!--<!--                    <div>-->--><?php ////echo $magasin['nomS']; ?><!--<!--</div>-->
<!--<!--                    <div>-->--><?php ////echo "Adresse : ".$magasin['rueS']; ?><!--<!--</div>-->
<!--<!--                    <div>-->--><?php ////echo "Ville : ".$magasin['villeS']; ?><!--<!--</div>-->
<!--<!--                    <div>-->--><?php ////echo "Directeur : ".$magasin['directeurS']; ?><!--<!--</div>-->
<!--<!--                </div>-->
<!--<!--            </div>-->
<!--<!--        -->--><?php ////} ?>
<!---->
<!---->
<!---->
<h3 class="text-center col-lg-12">Où sommes-nous ?</h3>
<div id="map"></div>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZZHZJJyA2yhVK-5Vm4qCJaAbDO6aw6fI&callback=initMap">
</script>
<script>
    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var mapOptions = {
            zoom: 8,
            center: latlng
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

<?php
foreach ($magasins as $magasin) {
  $adresse = $magasin['rueS']." ".$magasin['villeS'];
    $adresse = addslashes( $adresse );
    ?>
    <input type="button" value="Encode" onclick="codeAddress('<?php echo $adresse; ?>')">
    <?php
}
?>


<body onload="initialize()">
<div id="map" style="width: 320px; height: 480px;"></div>

</body>
