<?php

$usuario= "m";
$clave= "Duquesa2008";
$connection_string = 'DRIVER={SQL Server};SERVER=192.168.10.1;DATABASE=DUQUESA2021';

$conexion=odbc_connect($connection_string, $usuario, $clave);

  if(!$conexion=odbc_connect($connection_string, $usuario, $clave)){
    die('Error al conectarse a la base de datos');
  }else{

    //echo'conexion realizada';
  }

  error_reporting(0);
  
  //return $conexion; 

