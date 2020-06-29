
<?php  

include("database_connection.php");

$query = "SELECT dangerType FROM danger GROUP BY dangerType DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>


<!doctype html>
<html lang="fr">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <?php include 'links.php' ?>
  <title>Les graphes</title>

</head>

<body>

    <div class="container-fluid pt-5">
    <div class="row">
    </div>
    <div class="row mt-1">
        <div class="col-sm-0 col-md-2 col-lg-3"></div>
        <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="text-center mb-5">
                <a href="accueil.php">
                    <img src="img/logo.png" alt="logo" style="width: 200px; heigth: auto ">
                </a>
            </div>

            <!-- debut la barre de recherche -->
           <form action="detail.php" class="row mb-4">
                <input class="form-control" name="search" type="text" value="" id="search_user" placeholder="Rechercher un évènement" style="width: 92%;">
                <button class="btn p-0 rounded-0 border-info" name="submit" type="submit" value="search" style="width: 8%; background: gray; color: #fff; font-size: 23px;">
                    <i class="fas fa-search"></i>
                </button>
           </form>
            <!-- fin la barre de recherche -->

       <div class="col-md-12" style="position:relative;margin-top:-15px; margin-left:-30px;">
        <div class="list-group" id="show-list">
           
          
        </div>
       </div>
      

           <!-- debut liens en bas de la barre -->
            <div class="col">
                <ul class="row list-inline justify-content-center" >
                    <li class="mx-3"><a href="resultats_recherche.php"><i class="fas mr-1 fa-search"></i>Tous</a></li>
                    <li class="mx-3"><a id="active" href="graph.php"><i class="fas mr-1 fa-chart-line"></i>Graph</a></li>
                    <li class="mx-3"><a href="tableaux.php"><i class="fas mr-1 fa-table"></i>Tableaux</a></li>
                    <li class="mx-3"><a href="maps.php"><i class="fas mr-1 fa-map-marked-alt"></i>Maps</a></li>
                </ul>
            </div>
            
            <!-- fin liens en bas de la barre -->
        </div>  
    </div>

    <!-- debut section resultas de recherches //all -->


<div class="container">  
            <h3 align="center"> </h3>   
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                       <div class="col-md-3">
                            <select name="dangerType" class="form-control" id="dangerType"  data-live-search="true">

            
                               <option value="">Selectionner un bad event</option>
                            <?php
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["dangerType"].'">'.$row["dangerType"].'</option>';
                            }
                            ?>
                            </select>
                            </div>
                    </div>
                </div>
                    <div class="panel-body">
                    <div id="chart_area" style="width: 1000px; height: 500px;"></div>
                </div>
            </div>
        </div>  
     
    <!-- fin section resultas de recherches -->

    
</div>


</body>
</html>



<script>
$(document).ready(function(){

  $('#dangerType').selectpicker();

  
  load_data('recherche');

  function load_data(type, choix = '')
  {
    $.ajax({    url:"load_data.php",
      method:"POST",
      data:{type:type, choix:choix},
      dataType:"json",
      success:function(data)
      {
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
          html += '<option value="'+data[count].id+'">'+data[count].name+'</option>';
        }
        if(type == 'recherche')
        {
          $('#category_item').html(html);
          $('#category_item').selectpicker('refresh');
        }
        else
        {
         
        }
      }
    })
  }

  $(document).on('change', '#dangerType', function(){
    var choix = $('#dangerType').val();
    load_data('', choix);  });
  
});
</script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});



google.charts.setOnLoadCallback(chart_area);

function load_monthwise_data(dangerType, title)
{
    var temp_title = title + ' '+dangerType+'';
    $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{dangerType:dangerType},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart(data, temp_title);
        }
    });
}

function drawMonthwiseChart(danger, chart_main_title)
{
    var jsonData = danger;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'date');
    data.addColumn('number', 'typeActeur');
    $.each(jsonData, function(i, jsonData){
        var date = jsonData.date;
        var typeActeur = parseFloat($.trim(jsonData.typeActeur));
        data.addRows([[date, typeActeur]]);
    });
    var options = {
        title:chart_main_title,
        hAxis: {
            title: "", TextStyle: {color: '#871b47'}
        },
        vAxis: {
            title: "", TextStyle: {color: '#871b47'}
        }


    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}

</script>

<script>
    
$(document).ready(function(){

    $('#dangerType').change(function(){
        var dangerType = $(this).val();
        if(dangerType != '')
        {
            load_monthwise_data(dangerType, "");
        }
    });

});

</script>










  







