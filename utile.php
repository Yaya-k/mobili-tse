
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Modal -->
    <div class="modal fade" id="inscription" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p>Impossible de vous s'inscrire.... verifier que vous n'avez pas de compte </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <form role="form" action="index.php" method="post">
        <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Demande de mobilité</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Pays</label>
                                <select class="form-control" id="pays" required name="pays" >
                                    <option value="" selected disabled hidden>Choisir un pays</option>
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
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Ville</label>

                                <select class="form-control" id="ville" required name="ville">
                                    <option value="" selected disabled hidden>Choisir une ville</option>


                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Date debut</label>
                                <input type="date" class="form-control" id="inputEmail4" name="date_debut" required min="<?php echo date("Y-m-d"); ?>" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Date fin</label>
                                <input type="date" class="form-control" id="inputEmail4" name="date_fin" required min="<?php echo date("Y-m-d"); ?>" >
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="submiteMobilityDemand">Soumettre la demande</button>

                    </div>
                </div>
            </div>
        </div>

    </form>


    <!-- Modal -->
    <div class="modal fade" id="successMobilite" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p>Votre demande à bien etais enregistré </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="failMobilite" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p>Nous avons renconté un probleme.....  </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="deletedConfirmation" tabindex="-1" aria-labelledby="deletedConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        jQuery(function($) {
            var ville = {
                'Allemagne': ['Bochum', 'Giessen', 'Wildau'],
                'Belgique': ['Bruxelles'],
                'Bulgarie': ['Sofia'],
                'Espagne': ['Saragosse'],
                'Finlande': ['Tampere'],
                'Italie': ['Padoue','Milan'],
                'Portugal': ['Faro'],
                'Republique Tcheque': ['Prague'],
                'Lettonie': ['Riga']
            };

            var $ville = $('#ville');
            $('#pays').change(function () {
                var pays = $(this).val(), lcns = ville[pays] || [];

                var html = $.map(lcns, function(lcn){
                    return '<option value="' + lcn + '">' + lcn + '</option>'
                }).join('');
                $ville.html(html)
            });
        });

    </script>