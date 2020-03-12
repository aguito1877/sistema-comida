
<?php
    session_start();
    include '../library/configServer.php';
    include '../library/consulSQL.php';
    sleep(2);
    $nombre=$_POST['nombre-login'];
    $clave=md5($_POST['clave-login']);
    $radio=$_POST['optionsRadios'];
    if(!$nombre==""&&!$clave==""){
        $verUser=ejecutarSQL::consultar("select * from cliente where Nombre='$nombre' and Clave='$clave'");
        $verAdmin=ejecutarSQL::consultar("select * from administrador where Nombre='$nombre' and Clave='$clave'");
        if($radio=="option2"){
            $AdminC=mysqli_num_rows($verAdmin);
            if($AdminC>0){
                $_SESSION['nombreAdmin']=$nombre;
                $_SESSION['claveAdmin']=$clave;
				
				
				$codigo = "LOGIN_OK_ADMIN";
				$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
				$tipoAccion = "INGRESO";
				$mensaje = "USUARIO INGRESO CORRECTAMENTE [".$tipoAccion.": ".$codigo."]";
				
				echo '<img src="assets/img/error.png" class="center-all-contens"><br>'.$mensaje;
				ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$nombre','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");
				
				
				
				
                echo '<script> location.href="index.php"; </script>';
				
				
				
				
				
				
            }else{
				$codigo = "login_1";
				$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
				$tipoAccion = "ERROR";
				$mensaje = "Error nombre o contraseña invalido [".$tipoAccion.": ".$codigo."]";
				
				echo '<img src="assets/img/error.png" class="center-all-contens"><br>'.$mensaje;
				ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$nombre','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");

            }
        }
        if($radio=="option1"){
            $UserC=mysqli_num_rows($verUser);
            if($UserC>0){
                $_SESSION['nombreUser']=$nombre;
                $_SESSION['claveUser']=$clave;
               
                echo '<script> location.href="index.php"; </script>';
            }else{
				$codigo = "login_2";
				$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
				$tipoAccion = "ERROR";
				$mensaje = "Error nombre o contraseña invalido [".$tipoAccion.": ".$codigo."]";
				
				echo '<img src="assets/img/error.png" class="center-all-contens"><br>'.$mensaje;
				ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$nombre','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");
				
            }
        }

    }else{
			$codigo = "login_3";
			$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
			$tipoAccion = "ERROR";
			$mensaje = "Error campo vacío Intente nuevamente [".$tipoAccion.": ".$codigo."]";
			
			echo '<img src="assets/img/error.png" class="center-all-contens"><br>'.$mensaje;
			ejecutarSQL::consultar("insert ACCIONES values ('$codigo','$nombre','$tipoAccion','$mensaje','$curPageName',CURRENT_TIMESTAMP) ");
	
       
    }
?>