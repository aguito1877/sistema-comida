<?php
ob_start();
header("Content-type: text/javascript");

$con = @mysqli_connect("localhost", "root", "", "store");

$enlace = $_SERVER['HTTP_REFERER'];
if (!$enlace || $enlace == '') {
    die();
}

$sql = "SELECT num_visitas FROM visitas_abandonos WHERE nombre_pagina = '$enlace'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

$sqlSum = "SELECT SUM(num_visitas) AS total FROM visitas_abandonos";
$querySum = mysqli_query($con, $sqlSum);
$rowSum = mysqli_fetch_array($querySum);

if ($row['num_visitas'] > 0) {
    $sqlU = "UPDATE visitas_abandonos SET num_visitas=" . ($row['num_visitas'] + 1) . " WHERE nombre_pagina = '$enlace'";
    $sqlT = "UPDATE visitas_abandonos SET total_visitas=" . ($rowSum['total'] + 1) . " WHERE id_visitas > 0";

    if (mysqli_query($con, $sqlU)) {
        mysqli_query($con, $sqlT);
        print "document.write('" . ($row['num_visitas'] + 1) . "');";
    } else {
        echo "document.write('0');";
    }
} else {
    $sqlI = "INSERT INTO visitas_abandonos (nombre_pagina, num_visitas, total_visitas) VALUES ('$enlace', 1, 1)";
    if (mysqli_query($con, $sqlI)) {
        echo "document.write('1');";
    } else {
        echo "document.write('0');";
    }
}
//---------------------------------PAGINA ABANDONADA-----------------------------
session_start();
$abandono= "";
if ($_SESSION['anterior'] != NULL){
    $abandono = $_SESSION['anterior'];
}
if ($abandono != NULL && $abandono != "") {
    $sql = "SELECT num_abandonos FROM visitas_abandonos WHERE nombre_pagina = '$abandono'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    $sqlSum = "SELECT SUM(num_abandonos) AS totalA FROM visitas_abandonos";
    $querySum = mysqli_query($con, $sqlSum);
    $rowSum = mysqli_fetch_array($querySum);

    if ($row['num_abandonos'] > 0) {
        $sqlU = "UPDATE visitas_abandonos SET num_abandonos=" . ($row['num_abandonos'] + 1) . " WHERE nombre_pagina = '$abandono'";
        $sqlT = "UPDATE visitas_abandonos SET total_abandonos=" . ($rowSum['totalA'] + 1) . " WHERE id_visitas > 0";

        if (mysqli_query($con, $sqlU)) {
            mysqli_query($con, $sqlT);
        }
    }else{
        $sqlU = "UPDATE visitas_abandonos SET num_abandonos=1,total_abandonos=1 WHERE nombre_pagina = '$abandono'";
        mysqli_query($con, $sqlU);
    }
    $_SESSION['anterior'] = "$enlace";
}  else {
    $_SESSION['anterior'] = "http://localhost/OnlineStore/index.php";
}

ob_end_flush();
mysqli_close($con);
die();
