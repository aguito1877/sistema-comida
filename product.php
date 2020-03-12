<?php
session_start(); 
include './library/configServer.php';
include './library/consulSQL.php';
$_SESSION['t-product']=date('s'); 
$origen = basename($_SERVER['PHP_SELF']);
$anterior = $_GET['from'];
$t_anterior = 0;

if($anterior == 'index.php'){
  $t_anterior = $_SESSION['t-index']; 
}
if($anterior == 'registration.php'){
  $t_anterior = $_SESSION['t-registro'];
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
$t_actual = $_SESSION['t-product']=date('s');
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
    <link href="https://panel.chatcompose.com/static/global/export/css\main.af14124f.css" rel="stylesheet">    <script async type="text/javascript" src="https://panel.chatcompose.com/static/global/export/js\main.82da0a06.js" user="cecilio1877-ChatControl"></script>  
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156978057-2"></script>
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
    <section id="store">
       <br>
        <div class="container">
            <div class="page-header">
              <h1>Tienda <small class="tittles-pages-logo">Fast Lunch</small></h1>
            </div>
            <br><br>
            <div class="row">
                <div class="col-xs-12">
                    <ul id="store-links" class="nav nav-tabs" role="tablist">
                      <li role="presentation"><a href="#all-product" role="tab" data-toggle="tab" aria-controls="all-product" aria-expanded="false">Todos los productos</a></li>
                      <li role="presentation" class="dropdown active">
                        <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Categorías <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                          <!-- ==================== Lista categorias =============== -->
                          <?php
                            $categorias=  ejecutarSQL::consultar("select * from categoria");
                            while($cate=mysqli_fetch_array($categorias)){
                                echo '
                                    <li>
                                        <a href="#'.$cate['CodigoCat'].'" tabindex="-1" role="tab" id="'.$cate['CodigoCat'].'-tab" data-toggle="tab" aria-controls="'.$cate['CodigoCat'].'" aria-expanded="false">'.$cate['Nombre'].'
                                        </a>
                                    </li>';
                            }
                          ?>
                          <!-- ==================== Fin lista categorias =============== -->
                        </ul>
                      </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade" id="all-product" aria-labelledby="all-product-tab">
                          <br><br>
                        <div class="row">
                        <?php
                            $consulta=  ejecutarSQL::consultar("select * from producto where Stock > 0");
                            $totalproductos = mysqli_num_rows($consulta);
                            if($totalproductos>0){
								$nums=1;
                                while($fila=mysqli_fetch_array($consulta)){
                                   echo '
                                  <div class="col-xs-12 col-sm-6 col-md-3">
                                       <div class="thumbnail">
                                         <a href="infoProd.php?from='.$origen.'&CodigoProd='.$fila['CodigoProd'].'"><img src="assets/img-products/'.$fila['Imagen'].'"></a>
                                         <div class="caption">
                                           <h3>Hora máxima de reservación: '.$fila['Marca'].' horas</h3>
                                           <p>'.$fila['NombreProd'].'</p>
                                           <p>$'.$fila['Precio'].'</p>
                                           <p class="text-center">
                                               <a href="infoProd.php?from='.$origen.'&CodigoProd='.$fila['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                               <button value="'.$fila['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                           </p>

                                         </div>
                                       </div>
                                   </div> 
									
                                   ';
								   
								   if ($nums%4==0){
									   echo '<div class="clearfix"></div>';
								   }
								   $nums++;
                               }   
                            }else{
                                echo '<h2>No hay productos en esta categoria</h2>';
                            }  
                        ?>
                        </div>
                      </div><!-- Fin del contenedor de todos los productos -->
                      
                      <!-- ==================== Contenedores de categorias =============== -->
                      <?php
                        $consultar_categorias= ejecutarSQL::consultar("select * from categoria");
						$nums=1;
					   while($categ=mysqli_fetch_array($consultar_categorias)){
                            echo '<div role="tabpanel" class="tab-pane fade active in" id="'.$categ['CodigoCat'].'" aria-labelledby="'.$categ['CodigoCat'].'-tab"><br>';
                                $consultar_productos= ejecutarSQL::consultar("select * from producto where CodigoCat='".$categ['CodigoCat']."' and Stock > 0");
                                $totalprod = mysqli_num_rows($consultar_productos);
                                if($totalprod>0){
									$nums=1;
                                   while($prod=mysqli_fetch_array($consultar_productos)){
                                      echo '
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                             <div class="thumbnail">
                                               <a href="infoProd.php?CodigoProd='.$prod['CodigoProd'].'"><img src="assets/img-products/'.$prod['Imagen'].'"></a>
                                               <div class="caption">
                                                 <h3>'.$prod['Marca'].'</h3>
                                                 <p>'.$prod['NombreProd'].'</p>
                                                 <p>$'.$prod['Precio'].'</p>
                                                 <p class="text-center">
                                                     <a href="infoProd.php?CodigoProd='.$prod['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                                     <button value="'.$prod['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                                 </p>

                                               </div>
                                             </div>
                                         </div>     
                                         ';    
									 if ($nums%4==0){
									   echo '<div class="clearfix"></div>';
										}
									$nums++;	 
                                   } 
                                } else {
                                   echo '<h2>No hay productos en esta categoría</h2>'; 
                                }
                            echo '</div>'; 
                        }
                      ?>
                      <!-- ==================== Fin contenedores de categorias =============== -->
                    </div>
                </div>
            </div>
        </div>
    </section>
	
<?php
	
    //require 'requirelanguage.php';
	if ($_SESSION['nombreUser'] != "")
			$usuario = $_SESSION['nombreUser'];
		else if ($_SESSION['nombreAdmin'] != "")
			$usuario = $_SESSION['nombreAdmin'];

		
	$codigo = "INGRESO_OK_PRODUCTO";
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
	$tipoAccion = "INGRESO";
	$mensaje = "USUARIO INGRESO CORRECTAMENTE A PRODUCTOS[".$tipoAccion.": ".$codigo."]";
	ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$usuario','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");
	
	?>
    <?php include './inc/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $('#store-links a:first').tab('show');
        });
    </script>
</body>
</html>




