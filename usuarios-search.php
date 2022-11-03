<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['nombre', 'correo', 'fechaRegistro', 'habilitado'];

/* Nombre de la tabla */
$table = "personas";

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

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
//$sql2 = "SELECT usuario, nombre, correo, fechaRegistro, habilitado FROM usuarios u INNER JOIN personas p ON u.idPersona=p.idPersona";
$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;


/* Mostrado resultados */
$html = '';
$sqlVerMas  = "SELECT * FROM usuarios";
$res=mysqli_query($conexion,$sqlVerMas);


if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        
        

        $html .= '<tr>';
        
        $html .= '<th scope="row">' . $row['nombre'] . '</td>';
        $html .= '<td scope="row">' . $row['correo'] . '</td>';
        $html .= '<td scope="row">' . $row['fechaRegistro'] . '</td>';
        $html .= '<td scope="row">' . $row['habilitado'] . '</td>';
        if ($roww = $res->fetch_assoc) {
            $idUsuario = $roww['idUsuario'];
        $html .= '<td scope="row"><a class="btn btn-primary" href="usuario-ver-mas.php?id=<?php echo $idUsuario?>">Ver más</a></td>';}
        $html .= '</tr>';

    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>