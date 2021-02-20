<?php
include "navBar.php";

include "recherche.php";
include "rechercheRequest.php";

?>


<?php
$Allpays=array();
$Allpromo=array();
$AllnomPersone=array();
$reponseDynaCity = $bdd->query('SELECT nom, promo,pays,date_creation FROM demande_mobilite');

while ($val=$reponseDynaCity->fetch()){
    $AllnomPersone[]=$val['nom'];
    $Allpromo[]=$val['promo'];
    $Allpays[]=$val['pays'];

}

?>


    <?php
    if(isset($_POST['submitRecherche'])){
        $Allpays=array();
        $Allpromo=array();
        $AllnomPersone=array();
        $date_debut= $_POST['date_debut'];
        $promo= isset($_POST['promo'])? $_POST['promo']:"";
        $pays= isset($_POST['pays'])? $_POST['pays']:"";
        $nom= $_POST['nom'];
        $date_fin= $_POST['date_fin'];
        if(isset($_POST['nom']) and $_POST['nom']!=""){
            $result=searchWithName($_POST['nom'],$bdd);
            while ($val=$result->fetch()){
                $AllnomPersone[]=$val['nom'];
                $Allpromo[]=$val['promo'];
                $Allpays[]=$val['pays'];

            }
        }elseif (isset($_POST['promo'])){
            $result=searchWithPromo($_POST['promo'],$bdd);
            while ($val=$result->fetch()){
                $AllnomPersone[]=$val['nom'];
                $Allpromo[]=$val['promo'];
                $Allpays[]=$val['pays'];

            }
        }elseif (isset($_POST['pays'])){
            $result=searchWithPays($_POST['pays'],$bdd);
            while ($val=$result->fetch()){
                $AllnomPersone[]=$val['nom'];
                $Allpromo[]=$val['promo'];
                $Allpays[]=$val['pays'];

            }
        }elseif (isset($_POST['date_debut'])){
            $result=searchWithInfDates($_POST['date_debut'],$bdd);
            while ($val=$result->fetch()){
                $AllnomPersone[]=$val['nom'];
                $Allpromo[]=$val['promo'];
                $Allpays[]=$val['pays'];

            }
        }elseif (isset($_POST['date_fin'])){
            $result=searchWithSupDates($_POST['date_fin'],$bdd);
            while ($val=$result->fetch()){
                $AllnomPersone[]=$val['nom'];
                $Allpromo[]=$val['promo'];
                $Allpays[]=$val['pays'];

            }
        }

    }
    ?>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuGNAUyOVsfH_5u2ZlNBzPSoogI9aNAKo&callback=initMap">
    </script>
    <style>
        #map {
            height: 70%;
            width: 90%;
            margin-bottom: 10px;

        }
    </style>

    <script>
        const pays = {
            "Allemagne":{
                "lat": 51.165691,
                "long": 10.451526,
            },
            "Belgique":{
                "lat": 50.503887,
                "long": 4.469936,
            },
            "Bulgarie":{
                "lat": 42.733883,
                "long": 25.48583,
            },
            "Espagne":{
                "lat": 40.463667,
                "long": -3.74922,
            },
            "Finlande":{
                "lat": 61.92411,
                "long": 25.748151,
            },
            "Italie":{
                "lat": 41.87194,
                "long": 12.56738,
            },
            "Portugal":{
                "lat": 39.399872,
                "long": -8.224454,
            },
            "Republique Tcheque":{
                "lat": 49.817492,
                "long": 15.472962,
            },
            "Lettonie":{
                "lat": 55.169438,
                "long": 23.881275,
            }
        };

        function initMap() {
            let i;
// Create the map.
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 2,
                center: {lat: 23.885942, lng: 45.079162},
                mapTypeId: 'terrain'
            });

            // Construct the circle for each value in citymap.
            // Note: We scale the area of the circle based on the population.

            var nomPersonne = <?php echo json_encode($AllnomPersone); ?>;
            var promo = <?php echo json_encode($Allpromo); ?>;
            var Allpays = <?php echo json_encode($Allpays); ?>;

            for (i = 0; i<Allpays.length; i++){
                var marker = new google.maps.Marker({
                    position: {lat: pays[Allpays[i]]['lat'] , lng: pays[Allpays[i]]['long'] },
                    label: { color: '#000000', fontWeight: 'bold', fontSize: '14px', text: nomPersonne[i] },
                    optimized: false,
                    visible: true
                });
                marker.setMap(map);
            }

        }
    </script>
<div class="container">
    <div class="row">
        <div class="col-lg-8" style="height: 600px">
            <div id="map"></div>
        </div>
        <div class="col-lg-4">

        </div>

    </div>




