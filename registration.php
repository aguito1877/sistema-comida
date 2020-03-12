<?php 
 session_start(); 
 require 'requirelanguage.php';
 include 'library/configServer.php';
 include 'library/consulSQL.php'; 
 $_SESSION['t-registro']=date('s'); 
$origen = basename($_SERVER['PHP_SELF']);
$anterior = $_GET['from'];

if($anterior == 'index.php'){
  $t_anterior = $_SESSION['t-index']; 
}
if($anterior == 'product.php'){
  $t_anterior = $_SESSION['t-product'];
}
if($anterior == 'infoProd.php'){
  $t_anterior = $_SESSION['t-info']; 
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conectar = mysqli_connect($servername, $username, $password, $database) or die ('Error');


$p_anterior = $anterior; // variable $anterior
$p_actual = $origen;
$t_actual = $_SESSION['t-registro']=date('s');
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
    <title><?php echo $regt; ?></title>
    <?php include './inc/link.php'; 
    
    ?>
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
<body id="container-page-registration">
    <?php include './inc/navbar.php'; ?>
    <section id="form-registration">
        <div class="container">
            <div class="row">
                <div class="page-header">
                  <h1><?php echo $registro; ?> <small class="tittles-pages-logo">Fast Lunch</small></h1>
                </div>
                <div class="col-xs-12 col-sm-6 text-center">
                   <br><br><br>
                    <p><i class="fa fa-users fa-5x"></i></p>
                    <p class="lead">
                       <?php echo $al_registrarse; ?>
                        
    
                    </p>
                    <br>
                    <img src="assets/img/img-registration.png" alt="electrodomesticos" class="img-responsive">
                </div>
                <div class="col-xs-12 col-sm-6">
                   <br><br>
                    <div id="container-form">
                       <p style="color:#fff;" class="text-center lead"><?php echo $debera; ?></p>
                       <br><br>
                       <form class="form-horizontal FormCatElec" action="process/regclien.php" role="form" method="post" data-form="save">
                           <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="<?php echo $nit; ?>" required name="clien-nit" data-toggle="tooltip" data-placement="top" title="<?php echo $nit_err; ?>" maxlength="30" pattern="[0-9-]{14,30}">
                              </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="<?php echo $Inusuario; ?>" required name="clien-name" data-toggle="tooltip" data-placement="top" title="<?php echo $Inusuario_err; ?>" pattern="[a-zA-Z]{1,9}" maxlength="9">
                              </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="<?php echo $Innombre; ?>" required name="clien-fullname" data-toggle="tooltip" data-placement="top" title="<?php echo $Innombre_err; ?>" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                              </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="<?php echo $Inapellido; ?>" required name="clien-lastname" data-toggle="tooltip" data-placement="top" title="<?php echo $Inapellido_err; ?>" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                              </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                <input class="form-control all-elements-tooltip" type="password" placeholder="<?php echo $Incontrase単a; ?>" required name="clien-pass" data-toggle="tooltip" data-placement="top" title="<?php echo $Incontrase単a_err; ?>">
                              </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-home"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="<?php echo $Indireccion; ?>" required name="clien-dir" data-toggle="tooltip" data-placement="top" title="<?php echo $Indireccion_err; ?>" maxlength="100">
                              </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                <input class="form-control all-elements-tooltip" type="tel" placeholder="<?php echo $Intelefono; ?>" required name="clien-phone" maxlength="11" pattern="[0-9]{8,11}" data-toggle="tooltip" data-placement="top" title="<?php echo $Intelefono_err; ?>">
                              </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                <input class="form-control all-elements-tooltip" type="email" placeholder="<?php echo $Inemail; ?>" required name="clien-email" data-toggle="tooltip" data-placement="top" title="<?php echo $Inemail_err; ?>" maxlength="50">
                              </div>
                            </div>
                            <br>
                            <p><button type="submit" class="btn btn-success btn-block"><i class="fa fa-pencil"></i>&nbsp; <?php echo $inregi; ?></button></p>
                            <div class="ResForm" style="width: 100%; color: #fff; text-align: center; margin: 0;"></div>
                        </form> 
                    </div> 
                </div>
            </div>
        </div>
    </section>

<?php 
	
	
	if ($_SESSION['nombreUser'] != "")
		$usuario = $_SESSION['nombreUser'];
	else if ($_SESSION['nombreAdmin'] != "")
		$usuario = $_SESSION['nombreAdmin'];

	
	$codigo = "INGRESO_OK_REGISTRO";
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
	$tipoAccion = "INGRESO";
	$mensaje = "USUARIO INGRESO CORRECTAMENTE A REGISTRO[".$tipoAccion.": ".$codigo."]";
	ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$usuario','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");

  
  
?>	
	
	
    <?php include './inc/footer.php'; ?>
</body>
</html>