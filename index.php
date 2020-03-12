<?php 
	session_start(); 
    require 'requirelanguage.php';
	include 'library/configServer.php';
	include 'library/consulSQL.php';
    $_SESSION['t-index']=date('s'); 
   // echo $_SESSION['t-index-m']=date('s'); 
	include './inc/link.php';
	
?>

<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
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



    <title><?php echo $inicio; ?></title>

 </head>
<body id="container-page-index">
    <?php include './inc/navbar.php';?>
    <div class="jumbotron" id="jumbotron-index">
      <h1><span class="tittles-pages-logo">Lunch Fast</span> <small style="color: #fff;">Ecuador</small></h1>
      <p>
          
          <!--Visitas:--> <script type="text/javascript" src="http://localhost/OnlineStore/process/visitas.php"></script>
          <br> <?php echo $Bienvenido; 

            ?>
      </p>
    </div>
	
    <section id="new-prod-index">
         <div class="container">
            <div class="page-header">
                <h1><?php echo $nvdds; ?><small><?php echo $prs; ?></small></h1>
            </div>
            <div class="row">
              <?php
                            $busca="";
                            $busca=$_POST["busca"];
                            
                            $consultabusca=  ejecutarSQL::consultar("select * from producto where NombreProd like '%".$busca."%'");
                            $totalproductosbusca = mysqli_num_rows($consultabusca);
                            if($totalproductosbusca>0){
								$nums=1;
                                while($fila=mysqli_fetch_array($consultabusca)){
                                   echo '
                                  <div class="col-xs-12 col-sm-6 col-md-3">
                                       <div class="thumbnail">
                                         <a href="infoProd.php?CodigoProd='.$fila['CodigoProd'].'"><img src="assets/img-products/'.$fila['Imagen'].'"></a>
                                         <div class="caption">
                                           <h3>'.$fila['NombreProd'].'</h3>
                                           <p>Cantidad: '.$fila['Stock'].'</p>
                                           <p>Precio: $'.$fila['Precio'].'</p>
                                           <p>Hora maxima del pedido: '.$fila['Marca'].' horas.</p>
                                           <p class="text-center">
                                               <a href="infoProd.php?CodigoProd='.$fila['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
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
         </div>
    </section>
    <section id="reg-info-index">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 text-center">
                   <article style="margin-top:20%;">
                        <p><i class="fa fa-users fa-4x"></i></p>
                        <h3><?php echo $inregi; ?></h3>
                        <p> <?php echo $regtcli; ?> <span class="tittles-pages-logo">Lunch Fast</span><?php echo $parareci; ?></p>
                        <p><a href="registration.php" class="btn btn-info btn-block"><?php echo $inregi; ?></a></p>   
                   </article>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <img src="assets/img/Smart-TV-RegInfo.png" alt="Smart-TV" class="img-responsive">
                </div>
            </div>
        </div>
    </section>
    
    
    
    <?php  include './inc/footer.php';
    
    
    
    ?>
</body>
</html>



<?php 
	
	
	if ($_SESSION['nombreUser'] != "")
		$usuario = $_SESSION['nombreUser'];
	else if ($_SESSION['nombreAdmin'] != "")
		$usuario = $_SESSION['nombreAdmin'];

	
	$codigo = "INGRESO_OK_INDEX";
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
	$tipoAccion = "INGRESO";
	$mensaje = "USUARIO INGRESO CORRECTAMENTE A INDEX[".$tipoAccion.": ".$codigo."]";
	ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$usuario','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");

  
  
?>