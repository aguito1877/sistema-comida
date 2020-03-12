


<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
unset($_SESSION['producto']);
unset($_SESSION['contador']);
unset($_SESSION['sumaTotal']);
date_default_timezone_set('America/Guayaquil');		
    $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
 
    $arrayDias = array( 'Domingo', 'Lunes', 'Martes',
        'Miercoles', 'Jueves', 'Viernes', 'Sabado');

if (isset($_SESSION['nombreUser'])) {
    $ahora= $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y')." ".strftime("%H:%M")." horas ";
    $dia=  date('d');
    $usuario = $_SESSION['nombreUser'];
    consultasSQL::InsertSQL("efectividad1", "usuario, tiempo, dia", "'$usuario','$ahora','$dia'");
}else{
    $ahora= $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y')." ".strftime("%H:%M")." horas ";
    $usuario = "visitante";
    $dia=  date('d');
    consultasSQL::InsertSQL("efectividad1", "usuario, tiempo, dia", "'$usuario','$ahora','$dia'");
}

?>
<script>
    window.location = "../index.php";
</script>
