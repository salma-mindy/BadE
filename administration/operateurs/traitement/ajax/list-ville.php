    <?php
        
        // On se connecte à là base de données
        require_once "../../../../database/db.php";
        session_start();
        $idUser = $_SESSION["id"];
        @$idVille= strip_tags($_GET['id']);  
        $sql = 'SELECT * FROM ville WHERE pays = :idPays ORDER BY dateAjout DESC';
        // On prépare la requête
        $query = $db->prepare($sql);

        
        $query->bindValue(':idPays', $idVille, PDO::PARAM_INT);
        

        // On exécute
        $query->execute();
        // On récupère les valeurs dans un tableau associatif
        $ville = $query->fetchAll(PDO::FETCH_ASSOC);
        $d_nb = count($ville);
        //var_dump($d_nb);exit();
    ?>
    <div class="card-body">
        <?php if($d_nb === 0): ?>
        <center>
            <strong class="mt-4 mb-4">
                Pas d'informations disponible
            </strong>
        </center>
        <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="p-1">
                    <div class="table-responsive">
                        <table id="user_data" class="table table-striped table-sm table-bordered table-hover" style="color: #fff;">
                            <thead>
                                <tr class="text-center">
                                    <th>N</th>
                                    <th>Nom</th>
                                    <th>latitude</th>
                                    <th>longitude</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center text-secondary">
                                    <?php $i=1;  foreach($ville as $ville) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $i++ ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $ville['ville'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $ville['lat'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                echo $ville['lng'];
                                                ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($idUser == $ville['idUtilisateur']) {
                                                    echo '<a href="ajouter-ville.php?id='.$ville['id'].'&operation=modification" type="button" class="text-primary">
                                                    <i class="fa fa-edit fa-lg"></i>
                                                </a>&nbsp;&nbsp;
                                                <a class="text-danger" type="button" data-toggle="modal" data-target="#exampleModalCenter'.$ville["id"].'"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                                ';?>
                                                </td>
                                                <?php
                                                echo '<tr>
                                                <div class="modal fade" id="exampleModalCenter'.$ville["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="exampleModalLongTitle'.$ville["id"].'">Suppression ville</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-dark" >
                                                        Etes vous sur de vouloir supprimer  ?
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Annuler</button>
                                                            <a href="traitement/delete-ville.php?id='.$ville["id"].'" class="btn btn-danger">Supprimer</a> 
                                                    </div>
                        
                                                </div>
                                                </div>';
                                            }
                                            ?>
                                    </tr>
                                            <?php }; ?>
                                </tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>