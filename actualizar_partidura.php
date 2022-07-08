<?php

    session_start();

    include "connexion.php";
    
    $usuario = $_SESSION["UsuarioIngreso"];
 
    date_default_timezone_set('America/Bogota');
    $fechaHoy = date('Y-m-d');
    $horaHoy = date('H:i:s');
    $anioHoy = date('Y');
    
    $mesHoy = date('m');
    $minutoHoy = date('i');   

    if(isset($_POST['id_nuevo'])){
        $id = $_POST['id_nuevo'];
        
        
        $query = "SELECT * FROM DUQUESA..TBL_RPARTIDURAS_JUNTA_DUQ WHERE PAR_NID = $id";
        $result= odbc_exec($conexion, $query);
    
        while($row = odbc_fetch_array($result)){
    
            
            $PAR_NID=$row['PAR_NID'];
            $PAR_CPARTIDURA=$row['PAR_CPARTIDURA'];
            $PAR_CCANTIDAD=$row['PAR_CCANTIDAD'];
            $PAR_D_FECHA_REGISTRO=$row['PAR_D_FECHA_REGISTRO'];
            $PAR_DHORA_REGISTRO=$row['PAR_DHORA_REGISTRO'];
            $PAR_DANIO=$row['PAR_DANIO'];
            $PAR_DMES=$row['PAR_DMES'];
            $PAR_DFECHA=$row['PAR_DFECHA'];
            $PAR_CUSUARIO_REGISTRO=$row['PAR_CUSUARIO_REGISTRO'];
            $PAR_CESTADO=$row['PAR_CESTADO'];
            
            
        
        }

        
        if(!$result){
            //die(print_r(sqlsrv_errors(),true));
            die('Select Fallido');
        }
        
    }
    
    if(isset($_POST['enviar'])){
    
        $id = $_POST['id_nuevo'];
        $nuevaCantidad = $_POST['nuevaCantidad'];
        
        $newcanti = round($nuevaCantidad);

        //echo 'esta es la nueva cantidad: '.$newcanti; 
        //echo 'usuario update'.$usuario;

        $query = "UPDATE DUQUESA..TBL_RPARTIDURAS_JUNTA_DUQ SET PAR_CESTADO=0, 
         PAR_D_FECHA_REGISTRO_UPDATE = '$fechaHoy', PAR_DHORA_REGISTRO_UPDATE= '$horaHoy',
         PAR_CUSUARIO_UPDATE = '$usuario' WHERE PAR_NID ='$id'";

        $resultQuery=odbc_exec($conexion, $query);
        
        if(!$resultQuery){
            //die(print_r(sqlsrv_errors(),true));
            die('Actulizacion Fallida primer query');
        } 

        //$mes = MONTH(GETDATE());

        //echo 'usuario nuevo'.$usuario;
        
        $sqlquery ="INSERT INTO DUQUESA..TBL_RPARTIDURAS_JUNTA_DUQ (PAR_CPARTIDURA, PAR_CCANTIDAD,
        PAR_D_FECHA_REGISTRO, PAR_DHORA_REGISTRO, PAR_DANIO, PAR_DMES, PAR_DFECHA, PAR_CUSUARIO_REGISTRO,
        PAR_CESTADO) VALUES ('$PAR_CPARTIDURA', $newcanti, '$fechaHoy', '$horaHoy', '$anioHoy', 
        '$PAR_DMES', '$PAR_DFECHA', '$usuario', '1')";

        $resultsqlquery = odbc_exec($conexion, $sqlquery);

        if(!$resultsqlquery){
            //die(print_r(sqlsrv_errors(),true));
            die('Actulizacion Fallida Segundo query');
        } 
       
        /* echo '<script type="text/javascript"> 
        alert("Partidura Actualizada Correctamente.");
        window.location.href="index.php"
        </script>'; */
        
      
            
    }



?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Partida Actualizada</title>
        <link rel="icon" href="img/duquesa.ico" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <a href="index.php" class="nav-link" style="text-align: center; font-size: larger" ><strong>Partidura Actualizada Correctamente Click Aquí para continuar....</strong></a>
             
        </div> 
        

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

    </body>
    

</html> 

