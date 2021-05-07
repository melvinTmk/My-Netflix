<?php
require_once('connexion.php');

session_start();

if($_SESSION['admin'] == 0)
{
    header('Location:index.php');
}


$query = $bdd->query("SELECT avg(t1.note) as notemoy, t1.id_serie, t2.nom
FROM avis t1 LEFT JOIN series t2 ON t2.id = t1.id_serie GROUP BY t1.id_serie ORDER BY notemoy DESC LIMIT 5" );


         

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['nom', 'Note '],
          <?php
                while($donnees = $query->fetch())
                {
                
                    echo"['".$donnees['nom']."',".$donnees['notemoy']."],";
                    
                    
                }

          ?>
        ]);

        var options = {
          title: 'Les séries les plus aimées',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }

      
    </script>
</head>
<body>
  <style>
    body
    {
      background-color:#141414;
    }
    rect
    {
     fill:none;
    }
    text
    {
      fill : grey;
    }

    #piechart_3d
    {
      margin-left:250px;
    }
  </style>
    <div id="piechart_3d" style="width: 1200px; height: 700px; "></div> 
</body>
</html>