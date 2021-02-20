


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<br>
<br>


<section class="search-sec">
    <div class="container">

        <form role="form" action="map.php" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                            <input type="text" class="form-control search-slt" placeholder="Nom de l'etudiant" name="nom">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 p-0">

                            <select class="form-control search-slt" id="exampleFormControlSelect1" name="promo">
                                <option value="" selected disabled hidden>Promo</option>
                                <option>Fise1</option>
                                <option>Fise2</option>
                                <option>Fise3</option>

                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                            <select class="form-control search-slt" id="exampleFormControlSelect1" name="pays">
                                <option value="" selected disabled hidden>Pays</option>
                                <option>Allemagne</option>
                                <option>Belgique</option>
                                <option>Bulgarie</option>
                                <option>Espagne</option>
                                <option>Finlande</option>
                                <option>Italie</option>
                                <option>Portugal</option>
                                <option>Republique Tcheque</option>
                                <option>Lettonie</option>
                            </select>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 p-0">

                            <input type="date" class="form-control search-slt" placeholder="date debut" name="date_debut">
                            <label>Borne inf</label>

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                            <input type="date" class="form-control search-slt" placeholder="date fin" name="date_fin">
                            <label>Borne Sup</label>

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                            <button type="submit" class="btn btn-danger wrn-btn" name="submitRecherche">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

