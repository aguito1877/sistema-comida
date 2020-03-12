<?php
session_start();
include './library/configServer.php';
include './library/consulSQL.php';
$origen = basename($_SERVER['PHP_SELF']);
$anterior = $_GET['from'];

if($anterior == 'index.php'){
  $t_anterior = $_SESSION['t-index']; 
}
if($anterior == 'product.php'){
  $t_anterior = $_SESSION['t-product'];
}
if($anterior == 'infoProd.php'){
  $t_anterior = $_SESSION['t-registro']; 
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conectar = mysqli_connect($servername, $username, $password, $database) or die ('Error');


$p_anterior = $anterior; // variable $anterior
$p_actual = $origen;
$t_actual = $_SESSION['t-info']=date('s');
$tiempo_necesario = $t_actual - $t_anterior;
if($tiempo_necesario < 0){
    $tiempo_necesario = $tiempo_necesario + 60 ;
}
$sql = "INSERT INTO `tiempo_transicion`(`pagina_origen`, `pagina_llegada`, `tiempo`) VALUES ('$anterior','$origen','$tiempo_necesario')";
$insertar = mysqli_query($conectar,$sql) or die(mysqli_error($conectar));



?>
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Productos</title>
    <?php include './inc/link.php'; ?>
    <link href="https://panel.chatcompose.com/static/global/export/css\main.af14124f.css" rel="stylesheet">    
    <script async type="text/javascript" src="https://panel.chatcompose.com/static/global/export/js\main.82da0a06.js" user="xlopez-ayuda"></script>
    
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156978057-2"></script>
Visitas: <script type="text/javascript" src="http://localhost/OnlineStore/process/visitas.php"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-156978057-2');
</script>

    <!-- clicky -->
    
  <script>var clicky_site_ids = clicky_site_ids || []; clicky_site_ids.push(101232897);</script>
<script async src="//static.getclicky.com/js"></script>
    
    
    
    
   
</head>
<body id="container-page-product">
    <?php include './inc/navbar.php'; ?>
    <section id="infoproduct">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1>Tienda <small class="tittles-pages-logo">Fast Lunch</small></h1>
                </div>
                <?php 
				
					if ($_SESSION['nombreUser'] != "")
					$usuario = $_SESSION['nombreUser'];
					else if ($_SESSION['nombreAdmin'] != "")
					$usuario = $_SESSION['nombreAdmin'];

				
				$codigo = "INGRESO_OK_INFO_PRODUCTO";
				$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
				$tipoAccion = "INGRESO";
				$mensaje = "USUARIO INGRESO CORRECTAMENTE A INFORMACION PRODUCTO[".$tipoAccion.": ".$codigo."]";
				ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$usuario','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");

                    $CodigoProducto=$_GET['CodigoProd'];
                    $productoinfo=  ejecutarSQL::consultar("select * from producto where CodigoProd='".$CodigoProducto."'");
                    while($fila=mysqli_fetch_array($productoinfo)){
                        echo '
                            <div class="col-xs-12 col-sm-6">
                                <h3 class="text-center">Información de producto</h3>
                                <br><br>
                                <h4><strong>Nombre: </strong>'.$fila['NombreProd'].'</h4><br>
                                <h4><strong>Sazón: </strong>'.$fila['Modelo'].'</h4><br>
                                <h4><strong>Hora: </strong>'.$fila['Marca'].'</h4><br>
                                <h4><strong>Precio: </strong>$'.$fila['Precio'].'</h4>

                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <br><br><br>
                                <img class="img-responsive" src="assets/img-products/'.$fila['Imagen'].'">
                            </div>
                            <br><br><br>
                            <div class="col-xs-12 text-center">
                                <a href="product.php" class="btn btn-lg btn-primary"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Regresar a la tienda</a> &nbsp;&nbsp;&nbsp; 
                                <button value="'.$fila['CodigoProd'].'" class="btn btn-lg btn-success botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Añadir al carrito</button>
                            </div>
                        ';
                    }
            
  
?>
				
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>