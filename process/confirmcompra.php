


<?php
session_start();

include '../library/configServer.php';
include '../library/consulSQL.php';
$num = $_POST['clien-number'];
if ($num == 'notlog') {
  $nameClien = $_POST['clien-name'];
  $passClien =  md5($_POST['clien-pass']);
}
if ($num == 'log') {
  $nameClien = $_POST['clien-name'];
  $passClien = $_POST['clien-pass'];
}
sleep(3);

$verdata =  ejecutarSQL::consultar("select * from cliente where Clave='" . $passClien . "' and Nombre='" . $nameClien . "'");
$num =  mysqli_num_rows($verdata);
if ($num > 0) {
  if ($_SESSION['sumaTotal'] > 0) {


    $data = mysqli_fetch_array($verdata);
    $nitC = $data['NIT'];
    $StatusV = "Pendiente";

    /*Insertando datos en tabla venta*/
    consultasSQL::InsertSQL("venta", "Fecha, NIT, Descuento, TotalPagar, Estado", "'" . date('d-m-Y') . "','" . $nitC . "','0','" . $_SESSION['sumaTotal'] . "','" . $StatusV . "'");

    /*recuperando el número del pedido actual*/
    $verId = ejecutarSQL::consultar("select * from venta where NIT='$nitC' order by NumPedido desc limit 1");
    while ($fila = mysqli_fetch_array($verId)) {
      $Numpedido = $fila['NumPedido'];
    }

    /*Insertando datos en detalle de la venta*/
    for ($i = 0; $i < $_SESSION['contador']; $i++) {
      consultasSQL::InsertSQL("detalle", "NumPedido, CodigoProd, CantidadProductos", "'$Numpedido', '" . $_SESSION['producto'][$i] . "', '1'");

      /*Restando un stock a cada producto seleccionado en el carrito*/
      $prodStock = ejecutarSQL::consultar("select * from producto where CodigoProd='" . $_SESSION['producto'][$i] . "'");
      while ($fila = mysqli_fetch_array($prodStock)) {
        $existencias = $fila['Stock'];
        consultasSQL::UpdateSQL("producto", "Stock=('$existencias'-1)", "CodigoProd='" . $_SESSION['producto'][$i] . "'");
      }
    }

    /*Vaciando el carrito*/
    unset($_SESSION['producto']);
    unset($_SESSION['contador']);

    echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El pedido se ha realizado con éxito';
    $t_inicio = $_SESSION['t-index-m'];
    $t_compra = date('s');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "store";

    $conectar = mysqli_connect($servername, $username, $password, $database) or die('Error');

    $t_total = $t_compra - $t_inicio;

    if ($t_total < 0) {
      $t_total = $t_total + 60;
    }

    $sql = "INSERT INTO `tiempo_transaccion`(`tipo`, `tiempo`) VALUES ('Compra','$t_total')";
    $insertar = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
  } else {

    $codigo = "ConfComp_1";
    $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
    $tipoAccion = "ERROR";
    $mensaje = "No has seleccionado ningún producto, revisa el carrito de compras [" . $tipoAccion . ": " . $codigo . "]";

    echo '<img src="assets/img/error.png" class="center-all-contens"><br>' . $mensaje;
    ejecutarSQL::consultar("insert ACCIONES values ('$codigo','usuario','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");
  }
} else {

  $codigo = "ConfComp_2";
  $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
  $tipoAccion = "ERROR";
  $mensaje = "El nombre o contraseña invalidos[" . $tipoAccion . ": " . $codigo . "]";

  echo '<img src="assets/img/error.png" class="center-all-contens"><br>' . $mensaje;
  ejecutarSQL::consultar("insert ACCIONES values ('$codigo','usuario','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");
}
