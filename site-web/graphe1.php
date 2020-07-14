
<?php include("entête.php")?>

<br><br>

          <!-- debut liens en bas de la barre -->
          <div class="col mt-3">
               <ul class="nav row list-inline justify-content-center" >
                    <li class="nav-item"><a class="nav-link active" href="search_result.php"><i class="fas mr-1 fa-search"></i>Tous</a></li>
                    <li class="nav-item"><a class="nav-link" href="graphe1.php"><i class="fas mr-1 fa-chart-line"></i>Graph</a></li>
                    <li class="nav-item"><a class="nav-link" href="tableaux.php"><i class="fas mr-1 fa-table"></i>Tableaux</a></li>
                    <li class="nav-item"><a class="nav-link" href="maps.php"><i class="fas mr-1 fa-map-marked-alt"></i>Maps</a></li>
                </ul>
            </div>
            
            <!-- fin liens en bas de la barre -->
        </div>  
    </div>
    <hr>

        </div>
         
        <div class=" d-flex justify-content-center">
        <div id="result">

        </div>
        </div> 


        <br/><br />
        <div class="container">   
            <br/>  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="panel-title">Données annuelles</h3>
                        </div>
                        <div class="col-sm-4">
                            <select name="year" class="form-control" id="year">
                            <option value="">Selectionner une année</option>
                            <?php
                                $annecompteur = 2012 ;
                                $i=0;
                                while ( $annecompteur <= date('Y') ) {

                                    echo '<option value="'.(date('Y') - $i).'">'.(date('Y') - $i).'</option>';
                                    $i++;
                                    $annecompteur ++;
                                    
                                }
                                foreach($result as $row)
                                {
                                    
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="graphe1" style="width: 1000px; height: 620px;"></div>
                </div>
            </div>
        </div>  
        <?php include("footer.php")?>