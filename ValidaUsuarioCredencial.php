<?php
    session_start();
    $Usuario = $_POST["Usuario"];
    $Password = $_POST["Password"];
    include "connexion.php";
    if($conexion){
        //$SELECT = ;
        
        /* $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); */
        $ConsultaUsuario = odbc_exec($conexion, "SELECT * FROM CONTROL_OFIMAEnterprise..MTUSUARIO  WHERE CODUSUARIO = '$Usuario' AND CODNIVEL = '3' AND CODUSUARIO IN ('CNINO', 'JCASILIMAS') ");
        if($ConsultaUsuario>0){

            while ($Dos = odbc_fetch_array($ConsultaUsuario)) {
                
                
             
                $sUsario = $Dos['CODUSUARIO'];
                $sNombre = $Dos['NOMBRE'];
                $sPassword = $Dos['PASSWORD'];
                $sPrivilegio = $Dos['CODNIVEL'];

                

            }
            
            
            if($sPassword == $Password){
                $_SESSION["UsuarioIngreso"] = $sUsario;
                $_SESSION["PrivilegioUsuario"] = $sPrivilegio;
                $_SESSION["NombreUsuario"] = $sNombre;

        
                switch($sPrivilegio){

                    case '3':
                        echo '<script> window.location="index.php"; </script>';
                        break;
                    case '22':
                        echo '<script> window.location="index.php"; </script>';
                        break;
                    
                    case '2':
                        echo '<script> alert("No tiene permisos para ingresar.");</script>';
                        echo '<script> window.location="logout.php"; </script>';
                        break;
                }
            }else{
                echo '<script> alert("Validar nuevamente, contraseña incorrecta.");</script>';
                echo '<script> window.location="logout.php"; </script>';
            }
        }else{
            echo '<script> alert("Validar nuevamente, usuario incorrecto. ");</script>';
            echo '<script> window.location="logout.php"; </script>'; 
        } 
    }else{
        echo '<script> window.location="logout.php"; </script>'; 
    } 
//sqlsrv_close();
?>