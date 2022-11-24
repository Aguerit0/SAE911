<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';
session_start();
$id = $_SESSION['idComisaria'];


/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id','nombre','fecha', 'turno', 'superior_de_turno', 'oficial_servicio','idComisaria','eliminado'];

/* Nombre de la tabla */
$table = "novedades_de_guardia";

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE idComisaria='$id' AND (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}


/* Consulta */
$sql = "SELECT " . implode(", ", $columns) . "
FROM $table
$where ";

if ($_SESSION['rol']==1) {
    $sql2 = "SELECT * FROM  novedades_de_guardia n INNER JOIN comisarias c WHERE (n.eliminado<1) AND (n.idComisaria=c.idComisaria) AND (fecha LIKE '%$campo%' OR turno LIKE '%$campo%' OR superior_de_turno LIKE '%$campo%' OR oficial_servicio LIKE '%$campo%' OR nombre LIKE '%$campo%')";
}else if ($_SESSION['rol']==0) {
    $sql2 = "SELECT * FROM novedades_de_guardia n INNER JOIN comisarias c WHERE (n.idComisaria=$id) AND (n.eliminado<1)  AND (c.idComisaria=$id) AND (fecha LIKE '%$campo%' OR turno LIKE '%$campo%' OR superior_de_turno LIKE '%$campo%' OR oficial_servicio LIKE '%$campo%' OR nombre LIKE '%$campo%')";
}


$resultado = $conexion->query($sql2);
$num_rows = $resultado->num_rows;



/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        if (($row['eliminado']>=1)) {
            
        }else{
        $html .= '<tr>';
        $html .= '<th scope="row">' . $row['nombre'] .'</td>';
        $html .= '<th scope="row">' . $row['fecha'] . '</td>';
        $html .= '<td scope="row">' . $row['turno'] . '</td>';
        $html .= '<td scope="row">' . $row['superior_de_turno'] . '</td>';
        $html .= '<td scope="row">' . $row['oficial_servicio'] . '</td>';
        $id=$row['id'];
        $html .= '<td scope="row"><a class="btn btn-primary" href="novedades-ver-mas.php?id=' . $row['id'] .'">Ver más</a></td>';
        $html .= '</tr>';   
        }
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>