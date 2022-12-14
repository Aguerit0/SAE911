<?php
  include('././conexion.php');
  
  //CONSULTA PARA GRÁFICOS DE COMISARIAS GENERALES
  $sql = "SELECT COUNT(n.idComisaria) AS idComisariaContador, c.nombre FROM novedades_de_guardia AS n INNER JOIN comisarias AS c ON n.idComisaria=c.idComisaria AND c.eliminado<1 GROUP BY c.nombre ORDER BY idComisariaContador ASC";
  $r = mysqli_query($conexion, $sql);
?>
<html>
  <head>
    <style>#grafica1{float: left;}</style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(grafica);

    function grafica() {
      var data = google.visualization.arrayToDataTable([
        ["Navegador","Participación"],
          <?php
            $i = 0;
            $n = mysqli_num_rows($r);
            while($row=mysqli_fetch_assoc($r)){

              print "['".$row["nombre"]."', ".$row["idComisariaContador"]."]";
              $i++;
              if($i<$n) print ",";
            }
          ?>
        ]);
      //
      var opciones = {
        title: 'Cantidad de Novedades de Guardia',
        colors:['#7FFF00'],
        fontSize:25,
        fontName:"Times",
        hAxis: {
          title: 'Comisarias',
          titleTextStyle: {color: 'blue', fontSize:30},
          textPosition: "out",
          textStyle: {color:"blue", fontSize:20, fontName:"Times",bold:true, italic: true}
        },
        vAxis: {
          title: 'Cantidad de Novedades',
          titleTextStyle: {color: '#0000FF', bold:true, fontSize:30, fontName: "Arial"},
          textStyle: {color: '#0000FF', bold:true, fontSize:20, fontName: "Arial"},
          gridlines: {color: 'gray'}
        },
        legend: { position: 'none'},
        titleTextStyle: { 
          color: "#7FFF00",
          fontSize: 40,
          italic: true 
        },
        bar:{groupWidth: "100%"},
        width:600,
        height: 600
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafica1"));
      chart.draw(data, opciones);
  }
  </script>
  </head>
  <body>
      <div id="grafica1" ></div>
  </body>
</html>