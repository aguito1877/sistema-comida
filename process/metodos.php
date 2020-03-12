<?php
////////////////////////////////////////////
//USUARIOS ACTIVOS
//Calcula el numero de usuarios activos
////////////////////////////////////////////
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

function usuarios_activos()
{
   //permitimos el uso de la variable portadora del numero ip en nuestra funcion
   global $REMOTE_ADDR;

   //asignamos un nombre memotecnico a la variable 
   $ip = $REMOTE_ADDR;
   //definimos el momento actual
   $ahora = time();   
   //actualizamos la tabla
   //borrando los registros de las ip inactivas (24 minutos)
   //$limite = $ahora-24*60;
   //consultasSQL::DeleteSQL("control_ip", "fecha<'".$limite."'");
  
   //miramos si el ip del visitante existe en nuestra tabla
   /*$result = ejecutarSQL::consultar("select ip, fecha from control_ip where ip = '$ip'");
      
   //si existe actualizamos el campo fecha
   if (mysqli_num_rows($result) != 0){
       consultasSQL::UpdateSQL("control_ip", "fecha='$ahora'", "ip='$ip'");      
   }
   //si no existe insertamos el registro correspondiente a la nueva sesion
   else{*/
       consultasSQL::InsertSQL("control_ip", "ip, fecha", "'$ip','$ahora'");
   //}

   //ejecutamos la sentencia sql
   mysqli_query($ssql);

   //calculamos el numero de sesiones
   $ssql = ejecutarSQL::consultar("select ip from control_ip");
   $result = mysqli_query($ssql);
   $usuarios = mysqli_num_rows($result);

   //liberamos memoria
   mysqli_free_result($result);

   //devolvemos el resultado
   return $usuarios;
}
?>

