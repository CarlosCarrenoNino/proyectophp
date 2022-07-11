<?php

    session_start();
    include "connexion.php";
    require 'funcion.php';
   
    date_default_timezone_set('America/Bogota');
    $fechaHoy = date('Y/m/d');
    $fechaMesHoy = date('Y-m');
    $horaHoy = date('H:i:s');
    $anioHoy = date('Y');
    $mesHoy = date('m')-1;
    $minutoHoy = date('i');   


    $asesor= $_SESSION['UsuarioIngreso'];
    $nombre= $_SESSION["NombreUsuario"];       

    if(isset($_SESSION['UsuarioIngreso'])) {
        $Privilegio = $_SESSION["PrivilegioUsuario"];
        if ($Privilegio == "3"){
            
        }else{
            echo '<script> window.location="logout.php"; </script>';
        }
    }else{
        echo '<script> window.location="logout.php"; </script>';
    }  
    
    $estadosConsulta = 0;

    if(isset($_POST['enviar'])){

        $inicio = $_POST['fechainformeInicio'];
        $final = $_POST['fechainformeFin'];
        $rangofech = RangoFecha($inicio, $final);

        $SelectFiltro =$_POST['SelectFiltro'];
    
        //$rangofech = array_reverse($Meses);
        
        $estadosConsulta ++;



    }

    
   


?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Informe Junta Directiva Duquesa</title>
        <link rel="icon" href="img/duquesa.ico" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
            
            <a class="navbar-brand ps-3" href="index.php"><b>Informe Duquesa</b></a>
            
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!" style="color: white;" ><i class="fas fa-bars"></i></button>
            
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Partidas" style="margin-left:20px;" onclick="showCreateThanksYouForm()">
                <b>Partidas</b>
            </button>

            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <strong style="color: #FFFFFF;  margin-top: 10px;"><?php echo utf8_encode($nombre); ?></strong>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"  style="color: white;" ><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item btn btn-danger" href="login.php"><b>Cerrar Sesión</b></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"><b>MENU</b></div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-door-open"></i></div>
                                <b>Duquesa</b>
                            </a>
                            <div class="sb-sidenav-menu-heading"><b>Informes</b></div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                                <b>Reporteria</b>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <!-- <a class="nav-link" href="Informe2021.php">2021</a> -->
                                    <a class="nav-link" href="Informe_JD_Duquesa.php"><b>Informes</b></a>
                                    <!-- <a class="nav-link" href="Informe2022.php"><b>Comparativo</b></a> -->

                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                <b>Logout</b>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        <b>Cerrar Sesión</b>
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php"><b>Login</b></a>
                                        </nav>
                                    </div>
                                    
                                </nav>
                            </div>
                           <!--  <div class="sb-sidenav-menu-heading">Complementos</div>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Indicadores
                            </a>
                            <a class="nav-link" href="tabla.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tablas
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"><b>Conectado a:</b></div>
                        <b>DUQUESA S.A</b>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h3 class="mt-4">Informe Junta Directiva</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">DUQUESA S.A ESTADOS DE RESULTADOS AÑO <?php echo $anioHoy; ?></li>
                        </ol>                        
                        <div class="card-body" style="margin-top: -30px" >
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        
                                        <form action="#" method="POST">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="" style="margin-left: -17px;" ><b>Fecha Inicio: <?php echo $inicio; ?></b></label><br><br>                                                    
                                                    <input required type="month" class="form-control" max="<?php echo $anioHoy.'-0'.$mesHoy; ?>"  name="fechainformeInicio" id="fechainformeInicio1" style="margin-left: -17px;" >
                                                </div> 
                                                
                                                <div class="col-md-3">
                                                    <label for="" style="margin-left: -8px;" ><b>Fecha Fin: <?php echo $final; ?></b></label><br><br>
                                                    <input  type="month" class="form-control" max="<?php echo $anioHoy.'-0'.$mesHoy; ?>"  name="fechainformeFin" id="fechainformeFin1" style="margin-left: -8px;" >
                                                </div> 
                                                <div class="col-md-3">
                                                    <label for="" ><b>Filtrar por</b></label><br><br>
                                                    <select required list="SelectFiltro"  name="SelectFiltro" id="SelectFiltro" class="form-control" >
                                                        <option value="">Seleccione una Opción</option>
                                                        <option value="Mes_Acumulado">Acumulado Ejecutado</option>
                                                        <option value="Mes_a_Mes">Mes Ejecutado</option>
                                                    
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-danger"  name="enviar" id="enviar1" style="margin-block-start: 47px; margin-left: 8px;">
                                                    
                                                    <b>Consultar</b></button>

                                                </div>
                                            </div> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                           

                        </div>
                        

                        <?php
                        if($SelectFiltro == 'Mes_Acumulado'){
                           
                        ?> 
                        
                        <!-- Ventas Netas -->   
                        <div class="card mb-4">

                            
                                                        
                            <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#VentasNetas" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-shopping-cart me-1"></i>
                                <b>VENTAS NETAS <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="VentasNetas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id="" border="1"  class="table  table-hover" >
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                
                                                    foreach($rangofech as $rangomeses){

                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7; ">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7; ">
                                                            '.$trimes.' </th>'; 

                                                        }
                                                        
                                                    
                                                    }
                                                    
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7;">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7;">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                

                                                            
                                                foreach(Cuerpo() as $cp){

                                                    if($cp['ID']<=9){

                                                        
                                                                                                                                                            

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px; background:white; ">'.$cp['Concep'].'</td>
                                                                ';

                                                        
                                                            $sumaAcumul=0;
                                                            $sumaTri=0;

                                                            
                                                            foreach($rangofech as $mesregi){


                
                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES'];
                                                                    
                
                                                                /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                                $informe = "SELECT SUM(".$cp['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ WHERE INF_D_FECHAS BETWEEN '$fechaInicio'  AND '$fechaFinal'";
                                                                //echo $informe;
                                                                $consulinforme=odbc_exec($conexion, $informe);
                                                                $campo = odbc_result($consulinforme, 'resultado');
                                                            
                                                                if($fechaInicio == $fechaFinal){

                                                                    $sumaAcumul = $sumaAcumul + $campo;

                                                                }
                                                                
                                                                

                                                                    if($cp['ID']==4 && $cp['campo']=='(ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)'){
        
                                                                    
                                                                        echo '<td  style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campo,0).'</td>';
                                                                        
                                                                    }elseif($cp['ID']==8 && $cp['campo']=='(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA)'){
                                                                        
                                                                        echo '<td  style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campo,0).'</td>';
            
                                                                    }elseif($cp['ID']==9 && $cp['campo']=='((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))'){
                                                                        
                                                                        echo '<td  style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campo,0).'</td>';
            
                                                                    }


                                                                    if($cp['ID']!=4 && $cp['ID']!=8 && $cp['ID']!=9) {
                                                                    
                                                                        echo '<td  style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campo,0).'</td>';    
            
                                                                    }
                                                                
                                                            }                                                                                   
        
        
                                                            if($sumaAcumul == 0){
        
                                                                $promedio = 0;
                                                            }else{
        
                                                                $promedio = $sumaAcumul / count($rangofech);
                                                            }

                                                                
                                                            if($cp['ID']==4 && $cp['campo']=='(ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white;">$'.number_format($sumaAcumul,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp['ID']==8 && $cp['campo']=='(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA)'){
        
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';
        
                                                            }elseif($cp['ID']==9 && $cp['campo']=='((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';
        
                                                            }
        
        
                                                            if($cp['ID']!=4 && $cp['ID']!=8 && $cp['ID']!=9) {
        
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white;">$'.number_format($sumaAcumul,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white;">$'.number_format($promedio,0).'</td>';
        
                                                            }
                

                                                        echo'</tr>';
                                                        
                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                    <?php    
                                    }
                                ?>
                            </div>

                           
                        </div>

                         <!-- Costo de Ventas -->

                        <div class="card mb-4">
                            

                             <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#CostosVentas" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-university"></i>
                                <b>COSTOS DE VENTAS <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="CostosVentas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id="" border="1" class="table m-b-0 table-hover" >
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                foreach($rangofech as $rangomeses){

                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:#E6B8B7 ">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:#E6B8B7">
                                                            '.$trimes.' </th>'; 

                                                        }

                                                
                                                }
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:#E6B8B7;">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:#E6B8B7;">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                
                                                
                                                foreach(Cuerpo() as $cp2){

                                                    if($cp2['ID'] >= 10 && $cp2['ID'] <= 29){

                                                        $sumaAcumul2=0;
                                                        $sumaTri2=0;

                                                    

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px; background:white; ">'.$cp2['Concep'].'</td>
                                                                ';


                                                        foreach($rangofech as $mesregi){
                                                        

                                                            $fechaInicio = $mesregi['FechaI'];
                                                            $fechaFinal = $mesregi['FechaF'];
                                                            $Meses1 = $mesregi['CODMES'];
            
                                                        /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                        $informe2 = "SELECT SUM(".$cp2['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ WHERE INF_D_FECHAS  BETWEEN '$fechaInicio' AND '$fechaFinal'";
            
                                                        $consulinforme2=odbc_exec($conexion, $informe2);
            
                                                        $campos2 = odbc_result($consulinforme2, 'resultado');
                                                    
                                                        if($fechaInicio == $fechaFinal){

                                                            $sumaAcumul2 = $sumaAcumul2 + $campos2;

                                                        }


                                                        if($cp2['ID']==16 && $cp2['campo']=='(ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($campos2,0).'</td>';
                                                            
                                                        }elseif($cp2['ID']==24 && $cp2['campo']=='(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($campos2,0).'</td>';

                                                        }elseif($cp2['ID']==26 && $cp2['campo']=='((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($campos2,0).'</td>';

                                                        }elseif ($cp2['ID']==28 && $cp2['campo']=='(((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)))') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($campos2,0).'</td>';

                                                        }elseif($cp2['ID']==11 && $cp2['campo']=='((ACEITES2/ACEITES)*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;">'.number_format($campos2,1).'%'.'</td>';

                                                        }elseif($cp2['ID']==13 && $cp2['campo']=='((MARGARINAS2/MARGARINAS)*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">'.number_format($campos2,1).'%'.'</td>';
                                                        
                                                        }elseif($cp2['ID']==15 && $cp2['campo']=='((SOLIDOS_CREMOSOS2/SOLIDOS_CREMOSOS)*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==17 && $cp2['campo']=='((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)/(ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==19 && $cp2['campo']=='(INDUSTRIALES2/INDUSTRIALES)*100'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==21 && $cp2['campo']=='((ACIDOS_GRASOS_ACIDULADO2/ACIDOS_GRASOS_ACIDULADO)*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==23 && $cp2['campo']=='((SERVICIO_MAQUILA2/SERVICIO_MAQUILA)*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==25 && $cp2['campo']=='((INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)/(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA)*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==27 && $cp2['campo']=='(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==29 && $cp2['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                        }
                                                        

                                                        
                                                        
                                                        if($cp2['ID']!=16 && $cp2['ID']!=24 && $cp2['ID']!=26 && $cp2['ID']!=28 && $cp2['ID']!=11 && $cp2['ID']!=13 && $cp2['ID']!=15 && $cp2['ID']!=17 && $cp2['ID']!=19 && $cp2['ID']!=21 && $cp2['ID']!=23 && $cp2['ID']!=25 && $cp2['ID']!=27 && $cp2['ID']!=29 ) {

                                                            echo '<td id="fecha" style="text-align: right; style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;">$'.number_format($campos2,0).'</td>';    

                                                        } 


                                                        }                                                                                   



                                                        if($sumaAcumul2 == 0){

                                                            $promedio = 0;
                                                        }else{

                                                            $promedio = $sumaAcumul2 / count($rangofech);
                                                        }

                                                        if($cp2['ID']==16 && $cp2['campo']=='(ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($sumaAcumul2,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($promedio,0).'</td>';
                                                            
                                                        }elseif($cp2['ID']==24 && $cp2['campo']=='(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)'){

                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($sumaAcumul2,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp2['ID']==26 && $cp2['campo']=='((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($sumaAcumul2,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($promedio,0).'</td>';

                                                        }elseif ($cp2['ID']==28 && $cp2['campo']=='(((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)))') {
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($sumaAcumul2,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp2['ID']==11 && $cp2['campo']=='((ACEITES2/ACEITES)*100)'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp2['ID']==13 && $cp2['campo']=='((MARGARINAS2/MARGARINAS)*100)'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                        
                                                        }elseif($cp2['ID']==15 && $cp2['campo']=='((SOLIDOS_CREMOSOS2/SOLIDOS_CREMOSOS)*100)'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==17 && $cp2['campo']=='((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)/(ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)*100)'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==19 && $cp2['campo']=='(INDUSTRIALES2/INDUSTRIALES)*100'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==21 && $cp2['campo']=='((ACIDOS_GRASOS_ACIDULADO2/ACIDOS_GRASOS_ACIDULADO)*100)'){
                                                            
                                                        
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==23 && $cp2['campo']=='((SERVICIO_MAQUILA2/SERVICIO_MAQUILA)*100)'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==25 && $cp2['campo']=='((INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)/(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA)*100)'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==27 && $cp2['campo']=='(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                            
                                                        }elseif($cp2['ID']==29 && $cp2['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,1).'%'.'</td>';
                                                            
                                                        }

                                                        if($cp2['ID']!=16 && $cp2['ID']!=24 && $cp2['ID']!=26 && $cp2['ID']!=28 && $cp2['ID']!=11 && $cp2['ID']!=13 && $cp2['ID']!=15 && $cp2['ID']!=17 && $cp2['ID']!=19 && $cp2['ID']!=21 && $cp2['ID']!=23 && $cp2['ID']!=25 && $cp2['ID']!=27 && $cp2['ID']!=29){
                                                            
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($sumaAcumul2,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                            
                                                        } 
            
                                                        echo'</tr>';

                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                    <?php    
                                    }
                                ?>
                            </div>

                            
                        </div>

                        <!-- Gastos Operacionales -->

                        <div class="card mb-4">
                             
                            <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#GatosOperacionales" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-credit-card"></i>
                                <b>GASTOS OPERACIONALES <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="GatosOperacionales" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id="" border="1" class="table m-b-0 table-hover" >
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                foreach($rangofech as $rangomeses){
                                                    
                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7 ">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7 ">
                                                            '.$trimes.' </th>'; 

                                                        }
                                                    
                                                }
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7;">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7;">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                
                                                
                                                foreach(Cuerpo() as $cp3){

                                                    if($cp3['ID'] >= 30 && $cp3['ID'] <= 63){

                                                        $sumaAcumul3=0;
                                                        $TotalTri=0;

                                                        
                                                        

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px; background:white; ">'.$cp3['Concep'].'</td>
                                                                ';


                                                        foreach($rangofech as $mesregi){
                                                        

                                                            $fechaInicio = $mesregi['FechaI'];
                                                            $fechaFinal = $mesregi['FechaF'];
                                                            $Meses1 = $mesregi['CODMES'];
                                                            
            
            
            
                                                        /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                        $informe3 = "SELECT SUM(".$cp3['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ WHERE INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaFinal'";
            
                                                        //echo $informe;
                                                        $consulinforme3=odbc_exec($conexion, $informe3);
            
                                                        $campos3 = odbc_result($consulinforme3, 'resultado');

                                                        if($fechaInicio == $fechaFinal){

                                                            $sumaAcumul3 = $sumaAcumul3 + $campos3;

                                                        }
                                                        

                                                        if($cp3['ID']==30 && $cp3['campo']=='GASTOS_ADMINISTRACION'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            
                                                        }elseif($cp3['ID']==40 && $cp3['campo']=='GASTOS_VENTAS'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';

                                                        }elseif($cp3['ID']==58 && $cp3['campo']=='DEPRECIACIONES_AMORTIZACIONES'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';

                                                        }elseif ($cp3['ID']==60 && $cp3['campo']=='(GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==62 && $cp3['campo']=='(((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';

                                                        }elseif ($cp3['ID']==31 && $cp3['campo']=='(GASTOS_ADMINISTRACION/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==32 && $cp3['campo']=='GASTOS_PERSONAL') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==34 && $cp3['campo']=='HONORARIOS') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==33 && $cp3['campo']=='(GASTOS_PERSONAL/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==35 && $cp3['campo']=='(HONORARIOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100/)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==36 && $cp3['campo']=='SERVICIOS') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==37 && $cp3['campo']=='(SERVICIOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==38 && $cp3['campo']=='(GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==39 && $cp3['campo']=='(OTROS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==41 && $cp3['campo']=='(GASTOS_VENTAS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==42 && $cp3['campo']=='GASTOS_PERSONAL2') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==43 && $cp3['campo']=='(GASTOS_PERSONAL2/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==44 && $cp3['campo']=='POLIZA_CARTERA') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==45 && $cp3['campo']=='(POLIZA_CARTERA/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==46 && $cp3['campo']=='FLETES') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==47 && $cp3['campo']=='(FLETES/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==48 && $cp3['campo']=='SERVICIO_LOGISTICO') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==49 && $cp3['campo']=='(SERVICIO_LOGISTICO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==50 && $cp3['campo']=='ESTRATEGIA_COMERCIAL') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==51 && $cp3['campo']=='(ESTRATEGIA_COMERCIAL/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==52 && $cp3['campo']=='IMPUESTOS') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==53 && $cp3['campo']=='(IMPUESTOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==54 && $cp3['campo']=='DES_PRONTO_PAGO') {
                                                        
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                        }elseif ($cp3['ID']==55 && $cp3['campo']=='(DES_PRONTO_PAGO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==57 && $cp3['campo']=='((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==56 && $cp3['campo']=='(GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,1).'</td>';
                                                        }elseif ($cp3['ID']==59 && $cp3['campo']=='(DEPRECIACIONES_AMORTIZACIONES/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==61 && $cp3['campo']=='((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }elseif ($cp3['ID']==63 && $cp3['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                        }

                                                        
                                                        if($cp3['ID']!=30 && $cp3['ID']!=40 && $cp3['ID']!=58 && $cp3['ID']!=60 && $cp3['ID']!=62 && $cp3['ID']!=31 && $cp3['ID']!=32 && $cp3['ID']!=34 && $cp3['ID']!=33 && $cp3['ID']!=35 && $cp3['ID']!=36 && $cp3['ID']!=37 && $cp3['ID']!=38 && $cp3['ID']!=39 && $cp3['ID']!=41 && $cp3['ID']!=42 && $cp3['ID']!=43 && $cp3['ID']!=44 && $cp3['ID']!=45 && $cp3['ID']!=46 && $cp3['ID']!=47 && $cp3['ID']!=48 && $cp3['ID']!=49 && $cp3['ID']!=50 && $cp3['ID']!=51 && $cp3['ID']!=52 && $cp3['ID']!=53 && $cp3['ID']!=54 && $cp3['ID']!=55 && $cp3['ID']!=56 && $cp3['ID']!=57 && $cp3['ID']!=59 && $cp3['ID']!=61 && $cp3['ID']!=63) {

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px background:white;;">$'.number_format($campos3,0).'</td>';    

                                                        }

                                                        

                                                        }                                                                                   



                                                        if($sumaAcumul3 == 0){

                                                            $promedio = 0;
                                                        }else{

                                                            $promedio = $sumaAcumul3 / count($rangofech);
                                                        }

                                                        if($cp3['ID']==30 && $cp3['campo']=='GASTOS_ADMINISTRACION'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                            
                                                        }elseif($cp3['ID']==40 && $cp3['campo']=='GASTOS_VENTAS'){
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';                                                            

                                                        }elseif($cp3['ID']==58 && $cp3['campo']=='DEPRECIACIONES_AMORTIZACIONES'){
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';                                                                

                                                        }elseif ($cp3['ID']==60 && $cp3['campo']=='(GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)') {
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  

                                                        }elseif ($cp3['ID']==62 && $cp3['campo']=='(((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))') {
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  

                                                        }elseif ($cp3['ID']==31 && $cp3['campo']=='(GASTOS_ADMINISTRACION/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==32 && $cp3['campo']=='GASTOS_PERSONAL') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==34 && $cp3['campo']=='HONORARIOS') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==33 && $cp3['campo']=='(GASTOS_PERSONAL/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==35 && $cp3['campo']=='(HONORARIOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100/)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==36 && $cp3['campo']=='SERVICIOS') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==37 && $cp3['campo']=='(SERVICIOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==38 && $cp3['campo']=='(GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==39 && $cp3['campo']=='(OTROS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==41 && $cp3['campo']=='(GASTOS_VENTAS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==42 && $cp3['campo']=='GASTOS_PERSONAL2') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==43 && $cp3['campo']=='(GASTOS_PERSONAL2/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==44 && $cp3['campo']=='POLIZA_CARTERA') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==45 && $cp3['campo']=='(POLIZA_CARTERA/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==46 && $cp3['campo']=='FLETES') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==47 && $cp3['campo']=='(FLETES/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==48 && $cp3['campo']=='SERVICIO_LOGISTICO') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==49 && $cp3['campo']=='(SERVICIO_LOGISTICO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==50 && $cp3['campo']=='ESTRATEGIA_COMERCIAL') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==51 && $cp3['campo']=='(ESTRATEGIA_COMERCIAL/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==52 && $cp3['campo']=='IMPUESTOS') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==53 && $cp3['campo']=='(IMPUESTOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==54 && $cp3['campo']=='DES_PRONTO_PAGO') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==55 && $cp3['campo']=='(DES_PRONTO_PAGO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==56 && $cp3['campo']=='(GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==57 && $cp3['campo']=='((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==59 && $cp3['campo']=='(DEPRECIACIONES_AMORTIZACIONES/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==61 && $cp3['campo']=='((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                            
                                                        }elseif ($cp3['ID']==63 && $cp3['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';  
                                                            
                                                        }

                                                        if($cp3['ID']!=30 && $cp3['ID']!=40 && $cp3['ID']!=58 && $cp3['ID']!=60 && $cp3['ID']!=62 && $cp3['ID']!=31 && $cp3['ID']!=32 && $cp3['ID']!=34 && $cp3['ID']!=33 && $cp3['ID']!=35 && $cp3['ID']!=36 && $cp3['ID']!=37 && $cp3['ID']!=38 && $cp3['ID']!=39 && $cp3['ID']!=41 && $cp3['ID']!=42 && $cp3['ID']!=43 && $cp3['ID']!=44 && $cp3['ID']!=45 && $cp3['ID']!=46 && $cp3['ID']!=47 && $cp3['ID']!=48 && $cp3['ID']!=49  && $cp3['ID']!=50 && $cp3['ID']!=51 && $cp3['ID']!=52 && $cp3['ID']!=53 && $cp3['ID']!=54 && $cp3['ID']!=55 && $cp3['ID']!=56 && $cp3['ID']!=57 && $cp3['ID']!=59 && $cp3['ID']!=61 && $cp3['ID']!=63) {
                                                                
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }

                                                    
            
                                                        echo'</tr>';

                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                    <?php    
                                    }
                                ?>
                            </div>

                        </div>

                        <!--Gastos No Operacionales -->

                        <div class="card mb-4">
                            
                            <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#GatosNoOperacionales" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-shopping-bag me-1"></i>
                                <b>GASTOS NO OPERACIONALES <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="GatosNoOperacionales" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id="" border="1"  class="table m-b-0 table-hover" >
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                foreach($rangofech as $rangomeses){

                                                    $fechaInicio = $rangomeses['FechaI'];
                                                    $fechaFinal = $rangomeses['FechaF'];
                                                    $trimes = 'TRIMESTRE';

                                                    if($fechaInicio == $fechaFinal){

                                                        $mes = substr($fechaInicio,5,2);

                                                        $anio = substr($fechaInicio,0,4);

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7">
                                                        '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                    }else{

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7">
                                                        '.$trimes.' </th>'; 

                                                    }
                                                }
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7;">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7;">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                
                                                

                                                //$mesregistro = RangoFecha($inicio, $final);


                                                foreach(Cuerpo() as $cp4){


                                                    if($cp4['ID'] >= 64 && $cp4['ID'] <= 77){

                                                        $sumaAcumul4=0;

                                                                                                            

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp4['Concep'].'</td>
                                                                ';


                                                        foreach($rangofech as $mesregi){
                                                        

                                                            $fechaInicio = $mesregi['FechaI'];
                                                            $fechaFinal = $mesregi['FechaF'];
                                                            $Meses1 = $mesregi['CODMES']; 
            
            
            
                                                        /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                        $informe4 = "SELECT SUM(".$cp4['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ WHERE INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaFinal'";
            
                                                        //echo $informe;
                                                        $consulinforme4=odbc_exec($conexion, $informe4);
            
                                                        $campos4 = odbc_result($consulinforme4, 'resultado');

                                                        if($fechaInicio == $fechaFinal){

                                                            $sumaAcumul4 = $sumaAcumul4 + $campos4;

                                                        }
                                                                                                                                        

                                                        if($cp4['ID']==72 && $cp4['campo']=='((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';
                                                            
                                                        }elseif($cp4['ID']==74 && $cp4['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';

                                                        }elseif($cp4['ID']==76 && $cp4['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';

                                                        }elseif($cp4['ID']==65 && $cp4['campo']=='(FINANCIEROS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==66 && $cp4['campo']=='RETIRO_ACTIVOS'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';

                                                        }elseif($cp4['ID']==67 && $cp4['campo']=='(RETIRO_ACTIVOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==69 && $cp4['campo']=='(GRAVA_MOV_FINANCIERO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==71 && $cp4['campo']=='((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==73 && $cp4['campo']=='(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==75 && $cp4['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==77 && $cp4['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                        }


                                                        if($cp4['ID']!=72 && $cp4['ID']!=74 && $cp4['ID']!=76  && $cp4['ID']!=65 && $cp4['ID']!=66 && $cp4['ID']!=67  && $cp4['ID']!=69  && $cp4['ID']!=71  && $cp4['ID']!=73  && $cp4['ID']!=75  && $cp4['ID']!=77) {
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';    

                                                        }

                                                        
                                                        
                                                        
                                                        }                                                                                   


                                                        if($sumaAcumul4 == 0){

                                                            $promedio = 0;
                                                        }else{

                                                            $promedio = $sumaAcumul4 / count($rangofech);
                                                        }

                                                        if($cp4['ID']==72 && $cp4['campo']=='((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                                                                                    
                                                        }elseif($cp4['ID']==74 && $cp4['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))'){
                                                                                                                    
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp4['ID']==76 && $cp4['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))'){
                                                                                                                    
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp4['ID']==65 && $cp4['campo']=='(FINANCIEROS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                    
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,1).'%'.'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==66 && $cp4['campo']=='RETIRO_ACTIVOS'){
                                                                                                                    
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp4['ID']==67 && $cp4['campo']=='(RETIRO_ACTIVOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                    
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,1).'%'.'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==69 && $cp4['campo']=='(GRAVA_MOV_FINANCIERO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                    
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,1).'%'.'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==71 && $cp4['campo']=='((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                    
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,1).'%'.'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==73 && $cp4['campo']=='(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                    
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,1).'%'.'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp4['ID']==75 && $cp4['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                    
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                        }elseif($cp4['ID']==77 && $cp4['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                    
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,1).'%'.'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }


                                                        if($cp4['ID']!=72 && $cp4['ID']!=74 && $cp4['ID']!=76  && $cp4['ID']!=65 && $cp4['ID']!=66 && $cp4['ID']!=67  && $cp4['ID']!=69  && $cp4['ID']!=71  && $cp4['ID']!=73  && $cp4['ID']!=75  && $cp4['ID']!=77) {

                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }
                                                    
            
                                                        echo'</tr>';

                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                    <?php    
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- Ventas Toneladas -->
                        
                        <div class="card mb-4">
                            
                            <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#VetasToneladas" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-truck me-1"></i>
                                <b>TONELADAS <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="VetasToneladas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id="" border="1"  class="table m-b-0 table-hover" >
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                foreach($rangofech as $rangomeses){

                                                    $fechaInicio = $rangomeses['FechaI'];
                                                    $fechaFinal = $rangomeses['FechaF'];
                                                    $trimes = 'TRIMESTRE';

                                                    if($fechaInicio == $fechaFinal){

                                                        $mes = substr($fechaInicio,5,2);

                                                        $anio = substr($fechaInicio,0,4);

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:#E6B8B7 ">
                                                        '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                    }else{

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:#E6B8B7 ">
                                                        '.$trimes.' </th>'; 

                                                    }

                                                    
                                                }
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:#E6B8B7;">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:#E6B8B7;">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                
                                                
                                                foreach(Cuerpo() as $cp5){


                                                    if($cp5['ID'] >= 78 && $cp5['ID'] <= 85){

                                                        $sumaAcumul5=0;

                                                        

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp5['Concep'].'</td>
                                                                ';


                                                        foreach($rangofech as $mesregi){
                                                        
                                                            $fechaInicio = $mesregi['FechaI'];
                                                            $fechaFinal = $mesregi['FechaF'];
                                                            $Meses1 = $mesregi['CODMES']; 

                                                        //$informe5 = "EXEC [SPR_GET_TONELADAS] '$periodo','$Meses'"; 
                                                        $informe5 =" SELECT SUM(".$cp5['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ2 WHERE INF_D_FECHAS BETWEEN '$fechaInicio' AND  '$fechaFinal'";
            
                                                        //echo $informe5;
                                                        $consulinforme5=odbc_exec($conexion, $informe5);
            
                                                        $campos5 = odbc_result($consulinforme5, 'resultado');

                                                        if($fechaInicio == $fechaFinal){

                                                            $sumaAcumul5 = $sumaAcumul5 + $campos5;

                                                        }     
                                                        if($cp5['ID']==78 && $cp5['campo']=='(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';
                                                            
                                                        }elseif($cp5['ID']==82 && $cp5['campo']=='(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS)'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                        }elseif($cp5['ID']==85 && $cp5['campo']=='TON_SERVICIO_MAQUILA'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                        }elseif($cp5['ID']==79 && $cp5['campo']=='TON_ACEITES'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                        }elseif($cp5['ID']==80 && $cp5['campo']=='TON_MARGARINAS'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                        }elseif($cp5['ID']==81 && $cp5['campo']=='TON_SOLIDOS_CREMOSOS'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                        }elseif($cp5['ID']==83 && $cp5['campo']=='TON_INDUSTRIALES_OLEO'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                        }elseif($cp5['ID']==84 && $cp5['campo']=='TON_ACIDOS_GRASOS_ACIDULADO'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                        }


                                                        if($cp5['ID']!=78 && $cp5['ID']!=79 && $cp5['ID']!=80  && $cp5['ID']!=81 && $cp5['ID']!=82  && $cp5['ID']!=83  && $cp5['ID']!=84  && $cp5['ID']!=85) {

                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';    

                                                        }

                                                    
                                                        
                                                        
                                                        }                                                                                   


                                                    

                                                        if($sumaAcumul5 == 0){

                                                            $promedio = 0;
                                                        }else{

                                                            $promedio = $sumaAcumul5 / count($rangofech);
                                                        }

                                                        if($cp5['ID']==78 && $cp5['campo']=='(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';
                                                                                                                    
                                                        }elseif($cp5['ID']==82 && $cp5['campo']=='(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS)'){
                                                                                                                    
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                        }elseif($cp5['ID']==85 && $cp5['campo']=='TON_SERVICIO_MAQUILA'){
                                                                                                                    
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                        }elseif($cp5['ID']==79 && $cp5['campo']=='TON_ACEITES'){
                                                            
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                        }elseif($cp5['ID']==80 && $cp5['campo']=='TON_MARGARINAS'){
                                                            
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                        }elseif($cp5['ID']==81 && $cp5['campo']=='TON_SOLIDOS_CREMOSOS'){
                                                            
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                        }elseif($cp5['ID']==83 && $cp5['campo']=='TON_INDUSTRIALES_OLEO'){
                                                            
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                        }elseif($cp5['ID']==84 && $cp5['campo']=='TON_ACIDOS_GRASOS_ACIDULADO'){
                                                            
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                        }


                                                        if($cp5['ID']!=78 && $cp5['ID']!=79 && $cp5['ID']!=80  && $cp5['ID']!=81 && $cp5['ID']!=82  && $cp5['ID']!=83  && $cp5['ID']!=84  && $cp5['ID']!=85) {

                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                        }
                                                    
            
                                                        echo'</tr>';

                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                    <?php    
                                    }
                                ?>
                            </div>
                        </div> 

                        <!-- PRECIOS UNITARIOS -->

                        <div class="card mb-4">
                            <div class="card-headers">
                                <i style="margin-left:500px;" class="fas fa-user-circle me-1"></i>
                                <b>A PRECIO UNITARIO</b>                                    
                            </div>
                        </div>

                        <!-- VENTAS NETAS -->

                        <div class="card mb-4">
                            
                            <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#VetasNetas2" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-shopping-cart me-1"></i>
                                <b>VENTAS NETAS <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="VetasNetas2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id="" border="1" class="table m-b-0 table-hover" >
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                foreach($rangofech as $rangomeses){

                                                    $fechaInicio = $rangomeses['FechaI'];
                                                    $fechaFinal = $rangomeses['FechaF'];
                                                    $trimes = 'TRIMESTRE';

                                                    if($fechaInicio == $fechaFinal){

                                                        $mes = substr($fechaInicio,5,2);

                                                        $anio = substr($fechaInicio,0,4);

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7">
                                                        '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                    }else{

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7">
                                                        '.$trimes.' </th>'; 

                                                    }
                                                    
                                                }
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7;">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7;">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                
                                                
                                                foreach(Cuerpo() as $cp6){


                                                    if($cp6['ID'] >= 86 && $cp6['ID'] <= 94){

                                                        $sumaAcumul6=0;

                                                        

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp6['Concep'].'</td>
                                                                ';


                                                        foreach($rangofech as $mesregi){
                                                        

                                                            $fechaInicio = $mesregi['FechaI'];
                                                            $fechaFinal = $mesregi['FechaF'];
                                                            $Meses1 = $mesregi['CODMES'];          
            
            
                                                        /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                        $informe6 = "SELECT SUM(".$cp6['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ AS JD
                                                        INNER JOIN DUQUESA..TBL_RINFORME_JUNTA_DUQ2 AS JD2 ON JD.INF_D_FECHAS = JD2.INF_D_FECHAS AND JD.INF_D_ANIO = JD2.INF_D_ANIO AND 
                                                        JD.INF_D_MES = JD2.INF_D_MES WHERE JD.INF_D_FECHAS  BETWEEN '$fechaInicio' AND '$fechaFinal'";
            
                                                        //echo $informe;
                                                        $consulinforme6=odbc_exec($conexion, $informe6);
            
                                                        $campos6 = odbc_result($consulinforme6, 'resultado');

                                                        if($fechaInicio == $fechaFinal){

                                                            $sumaAcumul6 = $sumaAcumul6 + $campos6;

                                                        } 

                                                        if($cp6['ID']==89 && $cp6['campo']=='((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';
                                                            
                                                        }elseif($cp6['ID']==94 && $cp6['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                        }elseif($cp6['ID']==86 && $cp6['campo']=='(ACEITES/TON_ACEITES)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                        }elseif($cp6['ID']==87 && $cp6['campo']=='(MARGARINAS/TON_MARGARINAS)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                        }elseif($cp6['ID']==88 && $cp6['campo']=='(SOLIDOS_CREMOSOS/TON_SOLIDOS_CREMOSOS)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                        }elseif($cp6['ID']==90 && $cp6['campo']=='(INDUSTRIALES/TON_INDUSTRIALES_OLEO)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                        }elseif($cp6['ID']==91 && $cp6['campo']=='(ACIDOS_GRASOS_ACIDULADO/TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                        }elseif($cp6['ID']==92 && $cp6['campo']=='(SERVICIO_MAQUILA/TON_SERVICIO_MAQUILA)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                        }


                                                        if($cp6['ID']!=89 && $cp6['ID']!=94 && $cp6['ID']!=86  && $cp6['ID']!=87 && $cp6['ID']!=88  && $cp6['ID']!=90  && $cp6['ID']!=91  && $cp6['ID']!=92) {

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white;  ">$'.number_format($campos4,0).'</td>';    

                                                        }

                                                    
                                                        
                                                        
                                                        }                                                                                   


                                                    

                                                        if($sumaAcumul6 == 0){

                                                            $promedio = 0;
                                                        }else{

                                                            $promedio = $sumaAcumul6 / count($rangofech);
                                                        }

                                                        if($cp6['ID']==89 && $cp6['campo']=='((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                            
                                                        }elseif($cp6['ID']==94 && $cp6['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp6['ID']==86 && $cp6['campo']=='(ACEITES/TON_ACEITES)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp6['ID']==87 && $cp6['campo']=='(MARGARINAS/TON_MARGARINAS)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 220px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 220px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp6['ID']==88 && $cp6['campo']=='(SOLIDOS_CREMOSOS/TON_SOLIDOS_CREMOSOS)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp6['ID']==90 && $cp6['campo']=='(INDUSTRIALES/TON_INDUSTRIALES_OLEO)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp6['ID']==91 && $cp6['campo']=='(ACIDOS_GRASOS_ACIDULADO/TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp6['ID']==92 && $cp6['campo']=='(SERVICIO_MAQUILA/TON_SERVICIO_MAQUILA)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }


                                                        if($cp6['ID']!=89 && $cp6['ID']!=94 && $cp6['ID']!=86  && $cp6['ID']!=87 && $cp6['ID']!=88  && $cp6['ID']!=90  && $cp6['ID']!=91  && $cp6['ID']!=92) {

                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }


                                                    
            
                                                        echo'</tr>';

                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                    <?php    
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- COSTOS DE VENTAS -->

                        <div class="card mb-4">
                            
                            <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#CostosVentas2" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-university me-1"></i>
                                <b>COSTOS DE VENTAS <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="CostosVentas2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id=""  border="1" class="table m-b-0 table-hover">
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                foreach($rangofech as $rangomeses){

                                                    $fechaInicio = $rangomeses['FechaI'];
                                                    $fechaFinal = $rangomeses['FechaF'];
                                                    $trimes = 'TRIMESTRE';

                                                    if($fechaInicio == $fechaFinal){

                                                        $mes = substr($fechaInicio,5,2);

                                                        $anio = substr($fechaInicio,0,4);

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:#E6B8B7">
                                                        '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                    }else{

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:#E6B8B7">
                                                        '.$trimes.' </th>'; 

                                                    }

                                                    
                                                }
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:#E6B8B7; ">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:#E6B8B7; ">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                
                                                
                                                foreach(Cuerpo() as $cp7){


                                                    if($cp7['ID'] >= 95 && $cp7['ID'] <= 110){

                                                        $sumaAcumul7=0;

                                                        

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp7['Concep'].'</td>
                                                                ';


                                                        foreach($rangofech as $mesregi){
                                                        

                                                            $fechaInicio = $mesregi['FechaI'];
                                                            $fechaFinal = $mesregi['FechaF'];
                                                            $Meses1 = $mesregi['CODMES']; 
            
            
            
                                                        /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                        $informe7 = "SELECT SUM(".$cp7['campo'].") AS resultado FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ AS JD
                                                        INNER JOIN DUQUESA..TBL_RINFORME_JUNTA_DUQ2 AS JD2 ON JD.INF_D_FECHAS = JD2.INF_D_FECHAS AND JD.INF_D_ANIO = JD2.INF_D_ANIO AND 
                                                        JD.INF_D_MES = JD2.INF_D_MES WHERE JD.INF_D_FECHAS  BETWEEN '$fechaInicio' AND '$fechaFinal'"; 
                                                        //echo $informe;
                                                        $consulinforme7=odbc_exec($conexion, $informe7);
            
                                                        $campos7 = odbc_result($consulinforme7, 'resultado');

                                                        if($fechaInicio == $fechaFinal){

                                                            $sumaAcumul7 = $sumaAcumul7 + $campos7;

                                                        } 

                                                        if($cp7['ID']==107 && $cp7['campo']=='(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';
                                                            
                                                        }elseif($cp7['ID']==109 && $cp7['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white; ">$'.number_format($campos7,0).'</td>';

                                                        }elseif($cp7['ID']==95 && $cp7['campo']=='(ACEITES2/TON_ACEITES)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                        }elseif($cp7['ID']==96 && $cp7['campo']=='(((ACEITES2/TON_ACEITES)/(ACEITES/TON_ACEITES))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==97 && $cp7['campo']=='(MARGARINAS2/TON_MARGARINAS)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                        }elseif($cp7['ID']==98 && $cp7['campo']=='(((MARGARINAS2/TON_MARGARINAS)/(MARGARINAS/TON_MARGARINAS))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==99 && $cp7['campo']=='(SOLIDOS_CREMOSOS2/TON_SOLIDOS_CREMOSOS)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                        }elseif($cp7['ID']==100 && $cp7['campo']=='(((SOLIDOS_CREMOSOS2/TON_SOLIDOS_CREMOSOS)/(SOLIDOS_CREMOSOS/TON_SOLIDOS_CREMOSOS))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==101 && $cp7['campo']=='(INDUSTRIALES2/TON_INDUSTRIALES_OLEO)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                        }elseif($cp7['ID']==102 && $cp7['campo']=='(((INDUSTRIALES2/TON_INDUSTRIALES_OLEO)/(INDUSTRIALES/TON_INDUSTRIALES_OLEO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==103 && $cp7['campo']=='(ACIDOS_GRASOS_ACIDULADO2/TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                        }elseif($cp7['ID']==104 && $cp7['campo']=='(((ACIDOS_GRASOS_ACIDULADO2/TON_ACIDOS_GRASOS_ACIDULADO)/(ACIDOS_GRASOS_ACIDULADO/TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==105 && $cp7['campo']=='(SERVICIO_MAQUILA2/TON_SERVICIO_MAQUILA)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                        }elseif($cp7['ID']==106 && $cp7['campo']=='(((SERVICIO_MAQUILA2/TON_SERVICIO_MAQUILA)/(SERVICIO_MAQUILA/TON_SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==108 && $cp7['campo']=='((((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==110 && $cp7['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                        }


                                                        if($cp7['ID']!=107 && $cp7['ID']!=109 && $cp7['ID']!=95 && $cp7['ID']!=96 && $cp7['ID']!=97 && $cp7['ID']!=98 && $cp7['ID']!=99 && $cp7['ID']!=100 && $cp7['ID']!=101 && $cp7['ID']!=102 && $cp7['ID']!=103 && $cp7['ID']!=104 && $cp7['ID']!=105 && $cp7['ID']!=106 && $cp7['ID']!=108 && $cp7['ID']!=110 ) {

                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white; ">$'.number_format($campos7,0).'</td>';    

                                                        }

                                                    
                                                        
                                                        
                                                        }                                                                                   


                                                    

                                                        if($sumaAcumul7 == 0){

                                                            $promedio = 0;
                                                        }else{

                                                            $promedio = $sumaAcumul7 / count($rangofech);
                                                        }

                                                        if($cp7['ID']==107 && $cp7['campo']=='(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';
                                                            
                                                        }elseif($cp7['ID']==109 && $cp7['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){

                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';
                                                        }elseif($cp7['ID']==95 && $cp7['campo']=='(ACEITES2/TON_ACEITES)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp7['ID']==96 && $cp7['campo']=='(((ACEITES2/TON_ACEITES)/(ACEITES/TON_ACEITES))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==97 && $cp7['campo']=='(MARGARINAS2/TON_MARGARINAS)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp7['ID']==98 && $cp7['campo']=='(((MARGARINAS2/TON_MARGARINAS)/(MARGARINAS/TON_MARGARINAS))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==99 && $cp7['campo']=='(SOLIDOS_CREMOSOS2/TON_SOLIDOS_CREMOSOS)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp7['ID']==100 && $cp7['campo']=='(((SOLIDOS_CREMOSOS2/TON_SOLIDOS_CREMOSOS)/(SOLIDOS_CREMOSOS/TON_SOLIDOS_CREMOSOS))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==101 && $cp7['campo']=='(INDUSTRIALES2/TON_INDUSTRIALES_OLEO)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp7['ID']==102 && $cp7['campo']=='(((INDUSTRIALES2/TON_INDUSTRIALES_OLEO)/(INDUSTRIALES/TON_INDUSTRIALES_OLEO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==103 && $cp7['campo']=='(ACIDOS_GRASOS_ACIDULADO2/TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp7['ID']==104 && $cp7['campo']=='(((ACIDOS_GRASOS_ACIDULADO2/TON_ACIDOS_GRASOS_ACIDULADO)/(ACIDOS_GRASOS_ACIDULADO/TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==105 && $cp7['campo']=='(SERVICIO_MAQUILA2/TON_SERVICIO_MAQUILA)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp7['ID']==106 && $cp7['campo']=='(((SERVICIO_MAQUILA2/TON_SERVICIO_MAQUILA)/(SERVICIO_MAQUILA/TON_SERVICIO_MAQUILA))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==108 && $cp7['campo']=='((((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp7['ID']==110 && $cp7['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }

                                                        if($cp7['ID']!=107 && $cp7['ID']!=109 && $cp7['ID']!=95 && $cp7['ID']!=96 && $cp7['ID']!=97 && $cp7['ID']!=98 && $cp7['ID']!=99 && $cp7['ID']!=100 && $cp7['ID']!=101 && $cp7['ID']!=102 && $cp7['ID']!=103 && $cp7['ID']!=104 && $cp7['ID']!=105 && $cp7['ID']!=106 && $cp7['ID']!=108 && $cp7['ID']!=110) {

                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';
                                                        }

                                                    
            
                                                        echo'</tr>';

                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                    <?php    
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- GASTOS OPERACIONALES -->

                        <div class="card mb-4">
                            
                            <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#GastosOperacionales2" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-credit-card me-1"></i>
                                <b>GASTOS OPERACIONALES <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="GastosOperacionales2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id="" border="1" class="table m-b-0 table-hover">
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                foreach($rangofech as $rangomeses){

                                                    $fechaInicio = $rangomeses['FechaI'];
                                                    $fechaFinal = $rangomeses['FechaF'];
                                                    $trimes = 'TRIMESTRE';

                                                    if($fechaInicio == $fechaFinal){

                                                        $mes = substr($fechaInicio,5,2);

                                                        $anio = substr($fechaInicio,0,4);

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7">
                                                        '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                    }else{

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7">
                                                        '.$trimes.' </th>'; 

                                                    }

                                                    
                                                }
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7;">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7;">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                
                                                
                                                foreach(Cuerpo() as $cp8){


                                                    if($cp8['ID'] >= 111 && $cp8['ID'] <= 144){

                                                        $sumaAcumul8=0;

                                                        

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp8['Concep'].'</td>
                                                                ';


                                                        foreach($rangofech as $mesregi){
                                                        

                                                            $fechaInicio = $mesregi['FechaI'];
                                                            $fechaFinal = $mesregi['FechaF'];
                                                            $Meses1 = $mesregi['CODMES'];
            
            
            
                                                        /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                        $informe8 = "SELECT SUM(".$cp8['campo'].") AS resultado FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ AS JD
                                                        INNER JOIN DUQUESA..TBL_RINFORME_JUNTA_DUQ2 AS JD2 ON JD.INF_D_FECHAS = JD2.INF_D_FECHAS AND JD.INF_D_ANIO = JD2.INF_D_ANIO AND 
                                                        JD.INF_D_MES = JD2.INF_D_MES WHERE JD.INF_D_FECHAS  BETWEEN '$fechaInicio' AND '$fechaFinal'";
                                                        //echo $informe;
                                                        $consulinforme8=odbc_exec($conexion, $informe8);
            
                                                        $campos8 = odbc_result($consulinforme8, 'resultado');

                                                        if($fechaInicio == $fechaFinal){

                                                            $sumaAcumul8 = $sumaAcumul8 + $campos8;

                                                        } 

                                                        if($cp8['ID']==111 && $cp8['campo']=='(GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white;">$'.number_format($campos8,0).'</td>';
                                                            
                                                        }elseif($cp8['ID']==121 && $cp8['campo']=='(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==139 && $cp8['campo']=='(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==141 && $cp8['campo']=='((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==143 && $cp8['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==112 && $cp8['campo']=='((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==113 && $cp8['campo']=='(GASTOS_PERSONAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white;  ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==114 && $cp8['campo']=='((GASTOS_PERSONAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==115 && $cp8['campo']=='(HONORARIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==116 && $cp8['campo']=='((HONORARIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==117 && $cp8['campo']=='(SERVICIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==118 && $cp8['campo']=='((SERVICIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==119 && $cp8['campo']=='((GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==120 && $cp8['campo']=='(((GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==122 && $cp8['campo']=='((GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==123 && $cp8['campo']=='(GASTOS_PERSONAL2/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==124 && $cp8['campo']=='((GASTOS_PERSONAL2/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==125 && $cp8['campo']=='(POLIZA_CARTERA/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==126 && $cp8['campo']=='((POLIZA_CARTERA/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==127 && $cp8['campo']=='(FLETES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==128 && $cp8['campo']=='((FLETES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==129 && $cp8['campo']=='(SERVICIO_LOGISTICO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==130 && $cp8['campo']=='((SERVICIO_LOGISTICO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==131 && $cp8['campo']=='(ESTRATEGIA_COMERCIAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==132 && $cp8['campo']=='((ESTRATEGIA_COMERCIAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==133 && $cp8['campo']=='(IMPUESTOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==134 && $cp8['campo']=='((IMPUESTOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==135 && $cp8['campo']=='(DES_PRONTO_PAGO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==136 && $cp8['campo']=='((DES_PRONTO_PAGO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white;  ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==137 && $cp8['campo']=='((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                        }elseif($cp8['ID']==138 && $cp8['campo']=='(((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==140 && $cp8['campo']=='((DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==142 && $cp8['campo']=='(((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==144 && $cp8['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                        }


                                                        if($cp8['ID']!=111 && $cp8['ID']!=121 && $cp8['ID']!=139  && $cp8['ID']!=141 && $cp8['ID']!=143  && $cp8['ID']!=112  && $cp8['ID']!=113  && $cp8['ID']!=114  && $cp8['ID']!=115  && $cp8['ID']!=116  && $cp8['ID']!=117  && $cp8['ID']!=118  && $cp8['ID']!=119  && $cp8['ID']!=120  && $cp8['ID']!=122  && $cp8['ID']!=123  && $cp8['ID']!=124  && $cp8['ID']!=125  && $cp8['ID']!=126  && $cp8['ID']!=127  && $cp8['ID']!=128  && $cp8['ID']!=129  && $cp8['ID']!=130  && $cp8['ID']!=131  && $cp8['ID']!=132  && $cp8['ID']!=133  && $cp8['ID']!=134  && $cp8['ID']!=135  && $cp8['ID']!=136  && $cp8['ID']!=137  && $cp8['ID']!=138  && $cp8['ID']!=140  && $cp8['ID']!=142  && $cp8['ID']!=144) {

                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';    

                                                        }

                                                    
                                                        
                                                        
                                                        }                                                                                   


                                                    

                                                        if($sumaAcumul8 == 0){

                                                            $promedio = 0;
                                                        }else{

                                                            $promedio = $sumaAcumul8 / count($rangofech);
                                                        }

                                                        if($cp8['ID']==111 && $cp8['campo']=='(GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                            
                                                        }elseif($cp8['ID']==121 && $cp8['campo']=='(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==139 && $cp8['campo']=='(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==141 && $cp8['campo']=='((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==143 && $cp8['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==112 && $cp8['campo']=='((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==113 && $cp8['campo']=='(GASTOS_PERSONAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==114 && $cp8['campo']=='((GASTOS_PERSONAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==115 && $cp8['campo']=='(HONORARIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==116 && $cp8['campo']=='((HONORARIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==117 && $cp8['campo']=='(SERVICIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==118 && $cp8['campo']=='((SERVICIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==119 && $cp8['campo']=='((GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==120 && $cp8['campo']=='(((GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==122 && $cp8['campo']=='((GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==123 && $cp8['campo']=='(GASTOS_PERSONAL2/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==124 && $cp8['campo']=='((GASTOS_PERSONAL2/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==125 && $cp8['campo']=='(POLIZA_CARTERA/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==126 && $cp8['campo']=='((POLIZA_CARTERA/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==127 && $cp8['campo']=='(FLETES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==128 && $cp8['campo']=='((FLETES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==129 && $cp8['campo']=='(SERVICIO_LOGISTICO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==130 && $cp8['campo']=='((SERVICIO_LOGISTICO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==131 && $cp8['campo']=='(ESTRATEGIA_COMERCIAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==132 && $cp8['campo']=='((ESTRATEGIA_COMERCIAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==133 && $cp8['campo']=='(IMPUESTOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==134 && $cp8['campo']=='((IMPUESTOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==135 && $cp8['campo']=='(DES_PRONTO_PAGO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==136 && $cp8['campo']=='((DES_PRONTO_PAGO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==137 && $cp8['campo']=='((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp8['ID']==138 && $cp8['campo']=='(((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==140 && $cp8['campo']=='((DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==142 && $cp8['campo']=='(((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp8['ID']==144 && $cp8['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }


                                                        if($cp8['ID']!=111 && $cp8['ID']!=121 && $cp8['ID']!=139  && $cp8['ID']!=141 && $cp8['ID']!=143  && $cp8['ID']!=112  && $cp8['ID']!=113  && $cp8['ID']!=114  && $cp8['ID']!=115  && $cp8['ID']!=116  && $cp8['ID']!=117  && $cp8['ID']!=118  && $cp8['ID']!=119  && $cp8['ID']!=120  && $cp8['ID']!=122  && $cp8['ID']!=123  && $cp8['ID']!=124  && $cp8['ID']!=125  && $cp8['ID']!=126  && $cp8['ID']!=127  && $cp8['ID']!=128  && $cp8['ID']!=129  && $cp8['ID']!=130  && $cp8['ID']!=131  && $cp8['ID']!=132  && $cp8['ID']!=133  && $cp8['ID']!=134  && $cp8['ID']!=135  && $cp8['ID']!=136  && $cp8['ID']!=137  && $cp8['ID']!=138  && $cp8['ID']!=140  && $cp8['ID']!=142  && $cp8['ID']!=144) {

                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                        }

                                                    
            
                                                        echo'</tr>';

                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                    <?php    
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- GASTOS NO OPERACIONALES -->

                        <div class="card mb-4">
                            
                            <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#GastosNoOperacionales2" aria-expanded="false" aria-controls="collapseLayouts">
                                <i class="fas fa-shopping-bag me-1"></i>
                                <b>GASTOS NO OPERACIONALES <?php echo $anioHoy; ?></b>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            
                            <div class="card-body collapse" id="GastosNoOperacionales2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                
                                <br>
                                <?php
                                if($estadosConsulta == 1){?>
                                <div class="table-responsive">
                                    <table id="" border="1"  class="table m-b-0 table-hover" >
                                        <thead class="thead-color">
                                            <tr>
                                                
                                                <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                <?php
                                                foreach($rangofech as $rangomeses){

                                                    $fechaInicio = $rangomeses['FechaI'];
                                                    $fechaFinal = $rangomeses['FechaF'];
                                                    $trimes = 'TRIMESTRE';

                                                    if($fechaInicio == $fechaFinal){

                                                        $mes = substr($fechaInicio,5,2);

                                                        $anio = substr($fechaInicio,0,4);

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7">
                                                        '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                    }else{

                                                        echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7">
                                                        '.$trimes.' </th>'; 

                                                    }

                                                    
                                                }
                                                
                                                ?>
                                            
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7;">ACUMULADO</th>
                                                <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7;">PROMEDIO</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody >

                                                

                                                <?php
                                                
                                                
                                                foreach(Cuerpo() as $cp9){


                                                    if($cp9['ID'] >= 145 && $cp9['ID'] <= 158){

                                                        $sumaAcumul9=0;

                                                        

                                                        echo '<tr>
                                                                <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp9['Concep'].'</td>
                                                                ';


                                                        foreach($rangofech as $mesregi){
                                                        

                                                            $fechaInicio = $mesregi['FechaI'];
                                                            $fechaFinal = $mesregi['FechaF'];
                                                            $Meses1 = $mesregi['CODMES'];
            
            
            
                                                        /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                        $informe9 = "SELECT SUM(".$cp9['campo'].") AS resultado FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ AS JD
                                                        INNER JOIN DUQUESA..TBL_RINFORME_JUNTA_DUQ2 AS JD2 ON JD.INF_D_FECHAS = JD2.INF_D_FECHAS AND JD.INF_D_ANIO = JD2.INF_D_ANIO AND 
                                                        JD.INF_D_MES = JD2.INF_D_MES WHERE JD.INF_D_FECHAS  BETWEEN '$fechaInicio' AND '$fechaFinal'";
                                                        //echo $informe;
                                                        $consulinforme9=odbc_exec($conexion, $informe9);
            
                                                        $campos9 = odbc_result($consulinforme9, 'resultado');

                                                        if($fechaInicio == $fechaFinal){

                                                            $sumaAcumul9 = $sumaAcumul9 + $campos9;

                                                        } 

                                                        if($cp9['ID']==153 && $cp9['campo']=='((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';
                                                            
                                                        }elseif($cp9['ID']==155 && $cp9['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))-((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))'){

                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                        }elseif($cp9['ID']==157 && $cp9['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                        }elseif($cp9['ID']==145 && $cp9['campo']=='(FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                        }elseif($cp9['ID']==146 && $cp9['campo']=='((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==147 && $cp9['campo']=='(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                        }elseif($cp9['ID']==148 && $cp9['campo']=='((RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==149 && $cp9['campo']=='(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                        }elseif($cp9['ID']==150 && $cp9['campo']=='((GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==151 && $cp9['campo']=='((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                        }elseif($cp9['ID']==152 && $cp9['campo']=='(((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==154 && $cp9['campo']=='(((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==156 && $cp9['campo']=='((((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))-((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==158 && $cp9['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                        }


                                                        if($cp9['ID']!=153 && $cp9['ID']!=155 && $cp9['ID']!=157  && $cp9['ID']!=145 && $cp9['ID']!=146  && $cp9['ID']!=147  && $cp9['ID']!=148  && $cp9['ID']!=149  && $cp9['ID']!=150  && $cp9['ID']!=151  && $cp9['ID']!=152  && $cp9['ID']!=154  && $cp9['ID']!=156  && $cp9['ID']!=158) {

                                                            echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';    

                                                        }

                                                    
                                                        
                                                        
                                                        }                                                                                   


                                                    

                                                        if($sumaAcumul9 == 0){

                                                            $promedio = 0;
                                                        }else{

                                                            $promedio = $sumaAcumul9 / count($rangofech);
                                                        }

                                                        if($cp9['ID']==153 && $cp9['campo']=='((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp9['ID']==155 && $cp9['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))-((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))'){

                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp9['ID']==157 && $cp9['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                            echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp9['ID']==145 && $cp9['campo']=='(FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp9['ID']==146 && $cp9['campo']=='((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==147 && $cp9['campo']=='(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp9['ID']==148 && $cp9['campo']=='((RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==149 && $cp9['campo']=='(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp9['ID']==150 && $cp9['campo']=='((GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==151 && $cp9['campo']=='((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }elseif($cp9['ID']==152 && $cp9['campo']=='(((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white;">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==154 && $cp9['campo']=='(((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==156 && $cp9['campo']=='((((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))-((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }elseif($cp9['ID']==158 && $cp9['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                            
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,1).'%'.'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,1).'%'.'</td>';

                                                        }


                                                        if($cp9['ID']!=153 && $cp9['ID']!=155 && $cp9['ID']!=157  && $cp9['ID']!=145 && $cp9['ID']!=146  && $cp9['ID']!=147  && $cp9['ID']!=148  && $cp9['ID']!=149  && $cp9['ID']!=150  && $cp9['ID']!=151  && $cp9['ID']!=152  && $cp9['ID']!=154  && $cp9['ID']!=156  && $cp9['ID']!=158) {

                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                            echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                        }
                                                    
            
                                                        echo'</tr>';

                                                    }

                                                    

                                                }
                                                ?>

                                                                                        
                                            
                                        </tbody>
                                    </table>
                                </div>
                                    <?php    
                                    }
                                ?>
                            </div>
                        </div>


                        <!-- Mes Ejecutado -->

                        <?php
                        }elseif($SelectFiltro == 'Mes_a_Mes'){

                                $estadosConsulta2 = 0;
                            if(isset($_POST['enviar'])){

                                $inicio1 = $_POST['fechainformeInicio'];
                                $final1 = $_POST['fechainformeInicio'];
                                $rangofech1 = RangoFecha($inicio1, $final1);
                        
                                $SelectFiltro =$_POST['SelectFiltro'];
                            
                                //$rangofech1 = array_reverse($Meses1);
                                
                                
                                
                                $estadosConsulta2 ++;
                        
                        
                        
                            }

                            
                            ?>    
                            
                            <!-- Ventas Netas -->   
                            <div class="card mb-4">

                            
                                                        
                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#VentasNetas" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    <b>VENTAS NETAS <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="card-body collapse" id="VentasNetas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id="" border="1"  class="table m-b-0 table-hover" >
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    
                                                        foreach($rangofech1 as $rangomeses){

                                                            $fechaInicio = $rangomeses['FechaI'];
                                                            $fechaFinal = $rangomeses['FechaF'];
                                                            $trimes = 'TRIMESTRE';

                                                            if($fechaInicio == $fechaFinal){

                                                                $mes = substr($fechaInicio,5,2);

                                                                $anio = substr($fechaInicio,0,4);

                                                                echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7; ">
                                                                '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                            }else{

                                                                echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7; ">
                                                                '.$trimes.' </th>'; 

                                                            }
                                                            
                                                        
                                                        }
                                                        
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px;">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px;">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >

                                                    

                                                    <?php
                                                    

                                                                
                                                    foreach(Cuerpo() as $cp){

                                                        if($cp['ID']<=9){

                                                            
                                                                                                                                                                

                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px; background:white; ">'.$cp['Concep'].'</td>
                                                                    ';

                                                            
                                                                $sumaAcumul=0;
                                                                $sumaTri=0;

                                                                
                                                                foreach($rangofech1 as $mesregi){



                                                                    $fechaInicio = $mesregi['FechaI'];
                                                                    $fechaFinal = $mesregi['FechaF'];
                                                                    $Meses1 = $mesregi['CODMES'];
                                                                        

                                                                    /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                                    $informe = "SELECT SUM(".$cp['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ WHERE INF_D_FECHAS BETWEEN '$fechaInicio'  AND '$fechaInicio'";
                                                                    //echo $informe;
                                                                    $consulinforme=odbc_exec($conexion, $informe);
                                                                    $campo = odbc_result($consulinforme, 'resultado');
                                                                
                                                                    /* if($fechaInicio == $fechaFinal){

                                                                        $sumaAcumul = $sumaAcumul + $campo;

                                                                    } */
                                                                    
                                                                    

                                                                        if($cp['ID']==4 && $cp['campo']=='(ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)'){

                                                                        
                                                                            echo '<td  style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campo,0).'</td>';
                                                                            
                                                                        }elseif($cp['ID']==8 && $cp['campo']=='(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA)'){
                                                                            
                                                                            echo '<td  style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campo,0).'</td>';

                                                                        }elseif($cp['ID']==9 && $cp['campo']=='((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))'){
                                                                            
                                                                            echo '<td  style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campo,0).'</td>';

                                                                        }


                                                                        if($cp['ID']!=4 && $cp['ID']!=8 && $cp['ID']!=9) {
                                                                        
                                                                            echo '<td  style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campo,0).'</td>';    

                                                                        }
                                                                    
                                                                }                                                                                   


                                                                /* if($sumaAcumul == 0){

                                                                    $promedio = 0;
                                                                }else{

                                                                    $promedio = $sumaAcumul / count($rangofech);
                                                                }

                                                                    
                                                                if($cp['ID']==4 && $cp['campo']=='(ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)'){
                                                                    
                                                                    echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white;">$'.number_format($sumaAcumul,0).'</td>';
                                                                    echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                                }elseif($cp['ID']==8 && $cp['campo']=='(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA)'){

                                                                    echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul,0).'</td>';
                                                                    echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                                }elseif($cp['ID']==9 && $cp['campo']=='((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))'){
                                                                    
                                                                    echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul,0).'</td>';
                                                                    echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                                }


                                                                if($cp['ID']!=4 && $cp['ID']!=8 && $cp['ID']!=9) {

                                                                    echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white;">$'.number_format($sumaAcumul,0).'</td>';
                                                                    echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white;">$'.number_format($promedio,0).'</td>';

                                                                } */


                                                            echo'</tr>';
                                                            
                                                        }

                                                        

                                                    }
                                                    ?>

                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                        <?php    
                                        }
                                    ?>
                                </div>


                            </div>

                            <!-- Costo de Ventas -->

                            <div class="card mb-4">


                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#CostosVentas" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-university"></i>
                                    <b>COSTOS DE VENTAS <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="card-body collapse" id="CostosVentas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id="" border="1" class="table m-b-0 table-hover" >
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    foreach($rangofech1 as $rangomeses){

                                                            $fechaInicio = $rangomeses['FechaI'];
                                                            $fechaFinal = $rangomeses['FechaF'];
                                                            $trimes = 'TRIMESTRE';

                                                            if($fechaInicio == $fechaFinal){

                                                                $mes = substr($fechaInicio,5,2);

                                                                $anio = substr($fechaInicio,0,4);

                                                                echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:#E6B8B7 ">
                                                                '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                            }else{

                                                                echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:#E6B8B7">
                                                                '.$trimes.' </th>'; 

                                                            }

                                                    
                                                    }
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px;">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px;">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >

                                                    

                                                    <?php
                                                    
                                                    
                                                    foreach(Cuerpo() as $cp2){

                                                        if($cp2['ID'] >= 10 && $cp2['ID'] <= 29){

                                                            $sumaAcumul2=0;
                                                            $sumaTri2=0;

                                                        

                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px; background:white; ">'.$cp2['Concep'].'</td>
                                                                    ';


                                                            foreach($rangofech1 as $mesregi){
                                                            

                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES'];

                                                            /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                            $informe2 = "SELECT SUM(".$cp2['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ WHERE INF_D_FECHAS  BETWEEN '$fechaInicio' AND '$fechaInicio'";

                                                            $consulinforme2=odbc_exec($conexion, $informe2);

                                                            $campos2 = odbc_result($consulinforme2, 'resultado');
                                                        
                                                            /* f($fechaInicio == $fechaFinal){

                                                                $sumaAcumul2 = $sumaAcumul2 + $campos2;

                                                            } */


                                                            if($cp2['ID']==16 && $cp2['campo']=='(ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($campos2,0).'</td>';
                                                                
                                                            }elseif($cp2['ID']==24 && $cp2['campo']=='(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)'){

                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($campos2,0).'</td>';

                                                            }elseif($cp2['ID']==26 && $cp2['campo']=='((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($campos2,0).'</td>';

                                                            }elseif ($cp2['ID']==28 && $cp2['campo']=='(((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)))') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($campos2,0).'</td>';

                                                            }elseif($cp2['ID']==11 && $cp2['campo']=='((ACEITES2/ACEITES)*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;">'.number_format($campos2,1).'%'.'</td>';

                                                            }elseif($cp2['ID']==13 && $cp2['campo']=='((MARGARINAS2/MARGARINAS)*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">'.number_format($campos2,1).'%'.'</td>';
                                                            
                                                            }elseif($cp2['ID']==15 && $cp2['campo']=='((SOLIDOS_CREMOSOS2/SOLIDOS_CREMOSOS)*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">'.number_format($campos2,1).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==17 && $cp2['campo']=='((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)/(ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">'.number_format($campos2,1).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==19 && $cp2['campo']=='(INDUSTRIALES2/INDUSTRIALES)*100'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">'.number_format($campos2,1).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==21 && $cp2['campo']=='((ACIDOS_GRASOS_ACIDULADO2/ACIDOS_GRASOS_ACIDULADO)*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==23 && $cp2['campo']=='((SERVICIO_MAQUILA2/SERVICIO_MAQUILA)*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==25 && $cp2['campo']=='((INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)/(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA)*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==27 && $cp2['campo']=='(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==29 && $cp2['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($campos2,1).'%'.'</td>';
                                                                
                                                            }
                                                            

                                                            
                                                            
                                                            if($cp2['ID']!=16 && $cp2['ID']!=24 && $cp2['ID']!=26 && $cp2['ID']!=28 && $cp2['ID']!=11 && $cp2['ID']!=13 && $cp2['ID']!=15 && $cp2['ID']!=17 && $cp2['ID']!=19 && $cp2['ID']!=21 && $cp2['ID']!=23 && $cp2['ID']!=25 && $cp2['ID']!=27 && $cp2['ID']!=29 ) {

                                                                echo '<td id="fecha" style="text-align: right; style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;">$'.number_format($campos2,0).'</td>';    

                                                            } 


                                                            }                                                                                   



                                                            /* if($sumaAcumul2 == 0){

                                                                $promedio = 0;
                                                            }else{

                                                                $promedio = $sumaAcumul2 / count($rangofech);
                                                            }

                                                            if($cp2['ID']==16 && $cp2['campo']=='(ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($sumaAcumul2,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($promedio,0).'</td>';
                                                                
                                                            }elseif($cp2['ID']==24 && $cp2['campo']=='(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)'){

                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($sumaAcumul2,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp2['ID']==26 && $cp2['campo']=='((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($sumaAcumul2,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($promedio,0).'</td>';

                                                            }elseif ($cp2['ID']==28 && $cp2['campo']=='(((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)))') {
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($sumaAcumul2,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp2['ID']==11 && $cp2['campo']=='((ACEITES2/ACEITES)*100)'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp2['ID']==13 && $cp2['campo']=='((MARGARINAS2/MARGARINAS)*100)'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                            
                                                            }elseif($cp2['ID']==15 && $cp2['campo']=='((SOLIDOS_CREMOSOS2/SOLIDOS_CREMOSOS)*100)'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==17 && $cp2['campo']=='((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)/(ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)*100)'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==19 && $cp2['campo']=='(INDUSTRIALES2/INDUSTRIALES)*100'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==21 && $cp2['campo']=='((ACIDOS_GRASOS_ACIDULADO2/ACIDOS_GRASOS_ACIDULADO)*100)'){
                                                                
                                                            
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==23 && $cp2['campo']=='((SERVICIO_MAQUILA2/SERVICIO_MAQUILA)*100)'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==25 && $cp2['campo']=='((INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)/(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA)*100)'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==27 && $cp2['campo']=='(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                                
                                                            }elseif($cp2['ID']==29 && $cp2['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2)))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($sumaAcumul2,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white;  ">'.number_format($promedio,0).'%'.'</td>';
                                                                
                                                            }

                                                            if($cp2['ID']!=16 && $cp2['ID']!=24 && $cp2['ID']!=26 && $cp2['ID']!=28 && $cp2['ID']!=11 && $cp2['ID']!=13 && $cp2['ID']!=15 && $cp2['ID']!=17 && $cp2['ID']!=19 && $cp2['ID']!=21 && $cp2['ID']!=23 && $cp2['ID']!=25 && $cp2['ID']!=27 && $cp2['ID']!=29){
                                                                
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($sumaAcumul2,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 330px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                                
                                                            } */ 

                                                            echo'</tr>';

                                                        }

                                                        

                                                    }
                                                    ?>

                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                        <?php    
                                        }
                                    ?>
                                </div>


                            </div>

                            <!-- Gastos Operacionales -->

                            <div class="card mb-4">
                             
                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#GatosOperacionales" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-credit-card"></i>
                                    <b>GASTOS OPERACIONALES <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                
                                <div class="card-body collapse" id="GatosOperacionales" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    
                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id="" border="1" class="table m-b-0 table-hover" >
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    foreach($rangofech1 as $rangomeses){
                                                        
                                                            $fechaInicio = $rangomeses['FechaI'];
                                                            $fechaFinal = $rangomeses['FechaF'];
                                                            $trimes = 'TRIMESTRE';
    
                                                            if($fechaInicio == $fechaFinal){
    
                                                                $mes = substr($fechaInicio,5,2);
    
                                                                $anio = substr($fechaInicio,0,4);
    
                                                                echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7 ">
                                                                '.NombreMeses($mes).' '.$anio.' </th>'; 
    
                                                            }else{
    
                                                                echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7 ">
                                                                '.$trimes.' </th>'; 
    
                                                            }
                                                        
                                                    }
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; ">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; ">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >
    
                                                    
    
                                                    <?php
                                                    
                                                    
                                                    foreach(Cuerpo() as $cp3){
    
                                                        if($cp3['ID'] >= 30 && $cp3['ID'] <= 63){
    
                                                            $sumaAcumul3=0;
                                                            $TotalTri=0;
    
                                                            
                                                            
    
                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px; background:white; ">'.$cp3['Concep'].'</td>
                                                                    ';
    
    
                                                            foreach($rangofech1 as $mesregi){
                                                            
    
                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES'];
                                                                
                
                
                
                                                            /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                            $informe3 = "SELECT SUM(".$cp3['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ WHERE INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio'";
                
                                                            //echo $informe;
                                                            $consulinforme3=odbc_exec($conexion, $informe3);
                
                                                            $campos3 = odbc_result($consulinforme3, 'resultado');
    
                                                            /* if($fechaInicio == $fechaFinal){
    
                                                                $sumaAcumul3 = $sumaAcumul3 + $campos3;
    
                                                            } */
                                                            
    
                                                            if($cp3['ID']==30 && $cp3['campo']=='GASTOS_ADMINISTRACION'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                                
                                                            }elseif($cp3['ID']==40 && $cp3['campo']=='GASTOS_VENTAS'){
    
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
    
                                                            }elseif($cp3['ID']==58 && $cp3['campo']=='DEPRECIACIONES_AMORTIZACIONES'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
    
                                                            }elseif ($cp3['ID']==60 && $cp3['campo']=='(GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==62 && $cp3['campo']=='(((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
    
                                                            }elseif ($cp3['ID']==31 && $cp3['campo']=='(GASTOS_ADMINISTRACION/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==32 && $cp3['campo']=='GASTOS_PERSONAL') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==34 && $cp3['campo']=='HONORARIOS') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==33 && $cp3['campo']=='(GASTOS_PERSONAL/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==35 && $cp3['campo']=='(HONORARIOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100/)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==36 && $cp3['campo']=='SERVICIOS') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==37 && $cp3['campo']=='(SERVICIOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==38 && $cp3['campo']=='(GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==39 && $cp3['campo']=='(OTROS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==41 && $cp3['campo']=='(GASTOS_VENTAS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==42 && $cp3['campo']=='GASTOS_PERSONAL2') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==43 && $cp3['campo']=='(GASTOS_PERSONAL2/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==44 && $cp3['campo']=='POLIZA_CARTERA') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==45 && $cp3['campo']=='(POLIZA_CARTERA/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==46 && $cp3['campo']=='FLETES') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==47 && $cp3['campo']=='(FLETES/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==48 && $cp3['campo']=='SERVICIO_LOGISTICO') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==49 && $cp3['campo']=='(SERVICIO_LOGISTICO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==50 && $cp3['campo']=='ESTRATEGIA_COMERCIAL') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==51 && $cp3['campo']=='(ESTRATEGIA_COMERCIAL/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==52 && $cp3['campo']=='IMPUESTOS') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==53 && $cp3['campo']=='(IMPUESTOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==54 && $cp3['campo']=='DES_PRONTO_PAGO') {
                                                            
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==55 && $cp3['campo']=='(DES_PRONTO_PAGO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==57 && $cp3['campo']=='((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==56 && $cp3['campo']=='(GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos3,0).'</td>';
                                                            }elseif ($cp3['ID']==59 && $cp3['campo']=='(DEPRECIACIONES_AMORTIZACIONES/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==61 && $cp3['campo']=='((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }elseif ($cp3['ID']==63 && $cp3['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos3,1).'%'.'</td>';
                                                            }
    
                                                            
                                                            if($cp3['ID']!=30 && $cp3['ID']!=40 && $cp3['ID']!=58 && $cp3['ID']!=60 && $cp3['ID']!=62 && $cp3['ID']!=31 && $cp3['ID']!=32 && $cp3['ID']!=34 && $cp3['ID']!=33 && $cp3['ID']!=35 && $cp3['ID']!=36 && $cp3['ID']!=37 && $cp3['ID']!=38 && $cp3['ID']!=39 && $cp3['ID']!=41 && $cp3['ID']!=42 && $cp3['ID']!=43 && $cp3['ID']!=44 && $cp3['ID']!=45 && $cp3['ID']!=46 && $cp3['ID']!=47 && $cp3['ID']!=48 && $cp3['ID']!=49 && $cp3['ID']!=50 && $cp3['ID']!=51 && $cp3['ID']!=52 && $cp3['ID']!=53 && $cp3['ID']!=54 && $cp3['ID']!=55 && $cp3['ID']!=56 && $cp3['ID']!=57 && $cp3['ID']!=59 && $cp3['ID']!=61 && $cp3['ID']!=63) {
    
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px background:white;;">$'.number_format($campos3,0).'</td>';    
    
                                                            }
    
                                                            
    
                                                            }                                                                                   
    
    
    
                                                            /* if($sumaAcumul3 == 0){
    
                                                                $promedio = 0;
                                                            }else{
    
                                                                $promedio = $sumaAcumul3 / count($rangofech);
                                                            }
    
                                                            if($cp3['ID']==30 && $cp3['campo']=='GASTOS_ADMINISTRACION'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                                
                                                            }elseif($cp3['ID']==40 && $cp3['campo']=='GASTOS_VENTAS'){
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';                                                            
    
                                                            }elseif($cp3['ID']==58 && $cp3['campo']=='DEPRECIACIONES_AMORTIZACIONES'){
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';                                                                
    
                                                            }elseif ($cp3['ID']==60 && $cp3['campo']=='(GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)') {
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
    
                                                            }elseif ($cp3['ID']==62 && $cp3['campo']=='(((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))') {
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
    
                                                            }elseif ($cp3['ID']==31 && $cp3['campo']=='(GASTOS_ADMINISTRACION/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==32 && $cp3['campo']=='GASTOS_PERSONAL') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==34 && $cp3['campo']=='HONORARIOS') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==33 && $cp3['campo']=='(GASTOS_PERSONAL/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==35 && $cp3['campo']=='(HONORARIOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100/)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==36 && $cp3['campo']=='SERVICIOS') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==37 && $cp3['campo']=='(SERVICIOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==38 && $cp3['campo']=='(GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==39 && $cp3['campo']=='(OTROS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==41 && $cp3['campo']=='(GASTOS_VENTAS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==42 && $cp3['campo']=='GASTOS_PERSONAL2') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==43 && $cp3['campo']=='(GASTOS_PERSONAL2/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==44 && $cp3['campo']=='POLIZA_CARTERA') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==45 && $cp3['campo']=='(POLIZA_CARTERA/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==46 && $cp3['campo']=='FLETES') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==47 && $cp3['campo']=='(FLETES/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==48 && $cp3['campo']=='SERVICIO_LOGISTICO') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==49 && $cp3['campo']=='(SERVICIO_LOGISTICO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==50 && $cp3['campo']=='ESTRATEGIA_COMERCIAL') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==51 && $cp3['campo']=='(ESTRATEGIA_COMERCIAL/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==52 && $cp3['campo']=='IMPUESTOS') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==53 && $cp3['campo']=='(IMPUESTOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==54 && $cp3['campo']=='DES_PRONTO_PAGO') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==55 && $cp3['campo']=='(DES_PRONTO_PAGO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==56 && $cp3['campo']=='(GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==57 && $cp3['campo']=='((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==59 && $cp3['campo']=='(DEPRECIACIONES_AMORTIZACIONES/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==61 && $cp3['campo']=='((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }elseif ($cp3['ID']==63 && $cp3['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)') {
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul3,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';  
                                                                
                                                            }
    
                                                            if($cp3['ID']!=30 && $cp3['ID']!=40 && $cp3['ID']!=58 && $cp3['ID']!=60 && $cp3['ID']!=62 && $cp3['ID']!=31 && $cp3['ID']!=32 && $cp3['ID']!=34 && $cp3['ID']!=33 && $cp3['ID']!=35 && $cp3['ID']!=36 && $cp3['ID']!=37 && $cp3['ID']!=38 && $cp3['ID']!=39 && $cp3['ID']!=41 && $cp3['ID']!=42 && $cp3['ID']!=43 && $cp3['ID']!=44 && $cp3['ID']!=45 && $cp3['ID']!=46 && $cp3['ID']!=47 && $cp3['ID']!=48 && $cp3['ID']!=49  && $cp3['ID']!=50 && $cp3['ID']!=51 && $cp3['ID']!=52 && $cp3['ID']!=53 && $cp3['ID']!=54 && $cp3['ID']!=55 && $cp3['ID']!=56 && $cp3['ID']!=57 && $cp3['ID']!=59 && $cp3['ID']!=61 && $cp3['ID']!=63) {
                                                                    
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul3,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';
    
                                                            } */
    
                                                        
                
                                                            echo'</tr>';
    
                                                        }
    
                                                        
    
                                                    }
                                                    ?>
    
                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                        <?php    
                                        }
                                    ?>
                                </div>
 
                            </div>

                            <!--Gastos No Operacionales -->

                            <div class="card mb-4">

                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#GatosNoOperacionales" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-shopping-bag me-1"></i>
                                    <b>GASTOS NO OPERACIONALES <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="card-body collapse" id="GatosNoOperacionales" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id="" border="1"  class="table m-b-0 table-hover" >
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    foreach($rangofech1 as $rangomeses){

                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7">
                                                            '.$trimes.' </th>'; 

                                                        }
                                                    }
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px;">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px;">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >

                                                    

                                                    <?php
                                                    
                                                    

                                                    //$mesregistro = RangoFecha($inicio, $final);


                                                    foreach(Cuerpo() as $cp4){


                                                        if($cp4['ID'] >= 64 && $cp4['ID'] <= 77){

                                                            $sumaAcumul4=0;

                                                                                                                

                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp4['Concep'].'</td>
                                                                    ';


                                                            foreach($rangofech1 as $mesregi){
                                                            

                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES']; 



                                                            /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                            $informe4 = "SELECT SUM(".$cp4['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ WHERE INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio'";

                                                            //echo $informe;
                                                            $consulinforme4=odbc_exec($conexion, $informe4);

                                                            $campos4 = odbc_result($consulinforme4, 'resultado');

                                                            /* if($fechaInicio == $fechaFinal){

                                                                $sumaAcumul4 = $sumaAcumul4 + $campos4;

                                                            } */
                                                                                                                                            

                                                            if($cp4['ID']==72 && $cp4['campo']=='((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';
                                                                
                                                            }elseif($cp4['ID']==74 && $cp4['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))'){

                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';

                                                            }elseif($cp4['ID']==76 && $cp4['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';

                                                            }elseif($cp4['ID']==65 && $cp4['campo']=='(FINANCIEROS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                            }elseif($cp4['ID']==66 && $cp4['campo']=='RETIRO_ACTIVOS'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                            }elseif($cp4['ID']==67 && $cp4['campo']=='(RETIRO_ACTIVOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                            }elseif($cp4['ID']==69 && $cp4['campo']=='(GRAVA_MOV_FINANCIERO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                            }elseif($cp4['ID']==71 && $cp4['campo']=='((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                            }elseif($cp4['ID']==73 && $cp4['campo']=='(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                            }elseif($cp4['ID']==75 && $cp4['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                            }elseif($cp4['ID']==77 && $cp4['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos4,1).'%'.'</td>';

                                                            }


                                                            if($cp4['ID']!=72 && $cp4['ID']!=74 && $cp4['ID']!=76  && $cp4['ID']!=65 && $cp4['ID']!=66 && $cp4['ID']!=67  && $cp4['ID']!=69  && $cp4['ID']!=71  && $cp4['ID']!=73  && $cp4['ID']!=75  && $cp4['ID']!=77) {
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos4,0).'</td>';    

                                                            }

                                                            
                                                            
                                                            
                                                            }                                                                                   


                                                            /* if($sumaAcumul4 == 0){

                                                                $promedio = 0;
                                                            }else{

                                                                $promedio = $sumaAcumul4 / count($rangofech);
                                                            }

                                                            if($cp4['ID']==72 && $cp4['campo']=='((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                                                                                        
                                                            }elseif($cp4['ID']==74 && $cp4['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))'){
                                                                                                                        
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp4['ID']==76 && $cp4['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))'){
                                                                                                                        
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp4['ID']==65 && $cp4['campo']=='(FINANCIEROS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                        
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp4['ID']==66 && $cp4['campo']=='RETIRO_ACTIVOS'){
                                                                                                                        
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp4['ID']==67 && $cp4['campo']=='(RETIRO_ACTIVOS/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                        
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp4['ID']==69 && $cp4['campo']=='(GRAVA_MOV_FINANCIERO/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                        
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp4['ID']==71 && $cp4['campo']=='((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                        
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp4['ID']==73 && $cp4['campo']=='(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                        
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp4['ID']==75 && $cp4['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                        
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp4['ID']==77 && $cp4['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))*100)'){
                                                                                                                        
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul4,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }


                                                            if($cp4['ID']!=72 && $cp4['ID']!=74 && $cp4['ID']!=76  && $cp4['ID']!=65 && $cp4['ID']!=66 && $cp4['ID']!=67  && $cp4['ID']!=69  && $cp4['ID']!=71  && $cp4['ID']!=73  && $cp4['ID']!=75  && $cp4['ID']!=77) {

                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul4,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            } */
                                                        

                                                            echo'</tr>';

                                                        }

                                                        

                                                    }
                                                    ?>

                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                        <?php    
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- Ventas Toneladas -->

                            <div class="card mb-4">

                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#VetasToneladas" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-truck me-1"></i>
                                    <b>TONELADAS <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="card-body collapse" id="VetasToneladas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id="" border="1"  class="table m-b-0 table-hover" >
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    foreach($rangofech1 as $rangomeses){

                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:#E6B8B7 ">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:#E6B8B7 ">
                                                            '.$trimes.' </th>'; 

                                                        }

                                                        
                                                    }
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; ">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; ">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >

                                                    

                                                    <?php
                                                    
                                                    
                                                    foreach(Cuerpo() as $cp5){


                                                        if($cp5['ID'] >= 78 && $cp5['ID'] <= 85){

                                                            $sumaAcumul5=0;

                                                            

                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp5['Concep'].'</td>
                                                                    ';


                                                            foreach($rangofech1 as $mesregi){
                                                            
                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES']; 

                                                            //$informe5 = "EXEC [SPR_GET_TONELADAS] '$periodo','$Meses'"; 
                                                            $informe5 =" SELECT SUM(".$cp5['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ2 WHERE INF_D_FECHAS BETWEEN '$fechaInicio' AND  '$fechaInicio'";

                                                            //echo $informe5;
                                                            $consulinforme5=odbc_exec($conexion, $informe5);

                                                            $campos5 = odbc_result($consulinforme5, 'resultado');

                                                            /* if($fechaInicio == $fechaFinal){

                                                                $sumaAcumul5 = $sumaAcumul5 + $campos5;

                                                            }  */    
                                                            if($cp5['ID']==78 && $cp5['campo']=='(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';
                                                                
                                                            }elseif($cp5['ID']==82 && $cp5['campo']=='(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS)'){

                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                            }elseif($cp5['ID']==85 && $cp5['campo']=='TON_SERVICIO_MAQUILA'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                            }elseif($cp5['ID']==79 && $cp5['campo']=='TON_ACEITES'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                            }elseif($cp5['ID']==80 && $cp5['campo']=='TON_MARGARINAS'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                            }elseif($cp5['ID']==81 && $cp5['campo']=='TON_SOLIDOS_CREMOSOS'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                            }elseif($cp5['ID']==83 && $cp5['campo']=='TON_INDUSTRIALES_OLEO'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                            }elseif($cp5['ID']==84 && $cp5['campo']=='TON_ACIDOS_GRASOS_ACIDULADO'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';

                                                            }


                                                            if($cp5['ID']!=78 && $cp5['ID']!=79 && $cp5['ID']!=80  && $cp5['ID']!=81 && $cp5['ID']!=82  && $cp5['ID']!=83  && $cp5['ID']!=84  && $cp5['ID']!=85) {

                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($campos5,0).'</td>';    

                                                            }

                                                        
                                                            
                                                            
                                                            }                                                                                   


                                                        

                                                            /* if($sumaAcumul5 == 0){

                                                                $promedio = 0;
                                                            }else{

                                                                $promedio = $sumaAcumul5 / count($rangofech);
                                                            }

                                                            if($cp5['ID']==78 && $cp5['campo']=='(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';
                                                                                                                        
                                                            }elseif($cp5['ID']==82 && $cp5['campo']=='(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS)'){
                                                                                                                        
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                            }elseif($cp5['ID']==85 && $cp5['campo']=='TON_SERVICIO_MAQUILA'){
                                                                                                                        
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                            }elseif($cp5['ID']==79 && $cp5['campo']=='TON_ACEITES'){
                                                                
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                            }elseif($cp5['ID']==80 && $cp5['campo']=='TON_MARGARINAS'){
                                                                
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                            }elseif($cp5['ID']==81 && $cp5['campo']=='TON_SOLIDOS_CREMOSOS'){
                                                                
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                            }elseif($cp5['ID']==83 && $cp5['campo']=='TON_INDUSTRIALES_OLEO'){
                                                                
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                            }elseif($cp5['ID']==84 && $cp5['campo']=='TON_ACIDOS_GRASOS_ACIDULADO'){
                                                                
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                            }


                                                            if($cp5['ID']!=78 && $cp5['ID']!=79 && $cp5['ID']!=80  && $cp5['ID']!=81 && $cp5['ID']!=82  && $cp5['ID']!=83  && $cp5['ID']!=84  && $cp5['ID']!=85) {

                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($sumaAcumul5,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 265px; background:white; ">'.number_format($promedio,0).'</td>';

                                                            } */
                                                        

                                                            echo'</tr>';

                                                        }

                                                        

                                                    }
                                                    ?>

                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                        <?php    
                                        }
                                    ?>
                                </div>
                            </div> 

                            <!-- PRECIOS UNITARIOS -->

                            <div class="card mb-4">
                                <div class="card-headers">
                                    <i style="margin-left:500px;" class="fas fa-user-circle me-1"></i>
                                    <b>A PRECIO UNITARIO</b>                                    
                                </div>
                            </div>
                            

                            <!-- VENTAS NETAS -->

                            <div class="card mb-4">

                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#VetasNetas2" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    <b>VENTAS NETAS <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="card-body collapse" id="VetasNetas2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id="" border="1" class="table m-b-0 table-hover" >
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    foreach($rangofech1 as $rangomeses){

                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:#E6B8B7">
                                                            '.$trimes.' </th>'; 

                                                        }
                                                        
                                                    }
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px;">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px;">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >

                                                    

                                                    <?php
                                                    
                                                    
                                                    foreach(Cuerpo() as $cp6){


                                                        if($cp6['ID'] >= 86 && $cp6['ID'] <= 94){

                                                            $sumaAcumul6=0;

                                                            

                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp6['Concep'].'</td>
                                                                    ';


                                                            foreach($rangofech1 as $mesregi){
                                                            

                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES'];          


                                                            /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                            $informe6 = "SELECT SUM(".$cp6['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ AS JD, DUQUESA..TBL_RINFORME_JUNTA_DUQ2 AS JD2 WHERE JD.INF_D_FECHAS  BETWEEN '$fechaInicio' AND '$fechaInicio'  AND JD2.INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio' ";

                                                            //echo $informe;
                                                            $consulinforme6=odbc_exec($conexion, $informe6);

                                                            $campos6 = odbc_result($consulinforme6, 'resultado');

                                                            /* if($fechaInicio == $fechaFinal){

                                                                $sumaAcumul6 = $sumaAcumul6 + $campos6;

                                                            }  */

                                                            if($cp6['ID']==89 && $cp6['campo']=='((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';
                                                                
                                                            }elseif($cp6['ID']==94 && $cp6['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                            }elseif($cp6['ID']==86 && $cp6['campo']=='(ACEITES/TON_ACEITES)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                            }elseif($cp6['ID']==87 && $cp6['campo']=='(MARGARINAS/TON_MARGARINAS)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                            }elseif($cp6['ID']==88 && $cp6['campo']=='(SOLIDOS_CREMOSOS/TON_SOLIDOS_CREMOSOS)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                            }elseif($cp6['ID']==90 && $cp6['campo']=='(INDUSTRIALES/TON_INDUSTRIALES_OLEO)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                            }elseif($cp6['ID']==91 && $cp6['campo']=='(ACIDOS_GRASOS_ACIDULADO/TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                            }elseif($cp6['ID']==92 && $cp6['campo']=='(SERVICIO_MAQUILA/TON_SERVICIO_MAQUILA)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($campos6,0).'</td>';

                                                            }


                                                            if($cp6['ID']!=89 && $cp6['ID']!=94 && $cp6['ID']!=86  && $cp6['ID']!=87 && $cp6['ID']!=88  && $cp6['ID']!=90  && $cp6['ID']!=91  && $cp6['ID']!=92) {

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white;  ">$'.number_format($campos4,0).'</td>';    

                                                            }

                                                        
                                                            
                                                            
                                                            }                                                                                   


                                                        

                                                            /* if($sumaAcumul6 == 0){

                                                                $promedio = 0;
                                                            }else{

                                                                $promedio = $sumaAcumul6 / count($rangofech);
                                                            }

                                                            if($cp6['ID']==89 && $cp6['campo']=='((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                                
                                                            }elseif($cp6['ID']==94 && $cp6['campo']=='((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp6['ID']==86 && $cp6['campo']=='(ACEITES/TON_ACEITES)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp6['ID']==87 && $cp6['campo']=='(MARGARINAS/TON_MARGARINAS)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 220px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 220px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp6['ID']==88 && $cp6['campo']=='(SOLIDOS_CREMOSOS/TON_SOLIDOS_CREMOSOS)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp6['ID']==90 && $cp6['campo']=='(INDUSTRIALES/TON_INDUSTRIALES_OLEO)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp6['ID']==91 && $cp6['campo']=='(ACIDOS_GRASOS_ACIDULADO/TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp6['ID']==92 && $cp6['campo']=='(SERVICIO_MAQUILA/TON_SERVICIO_MAQUILA)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }


                                                            if($cp6['ID']!=89 && $cp6['ID']!=94 && $cp6['ID']!=86  && $cp6['ID']!=87 && $cp6['ID']!=88  && $cp6['ID']!=90  && $cp6['ID']!=91  && $cp6['ID']!=92) {

                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($sumaAcumul6,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 248px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            } */


                                                        

                                                            echo'</tr>';

                                                        }

                                                        

                                                    }
                                                    ?>

                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                        <?php    
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- COSTOS DE VENTAS -->

                            <div class="card mb-4">

                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#CostosVentas2" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-university me-1"></i>
                                    <b>COSTOS DE VENTAS <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="card-body collapse" id="CostosVentas2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id=""  border="1" class="table m-b-0 table-hover">
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    foreach($rangofech1 as $rangomeses){

                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:#E6B8B7">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:#E6B8B7">
                                                            '.$trimes.' </th>'; 

                                                        }

                                                        
                                                    }
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; ">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; ">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >

                                                    

                                                    <?php
                                                    
                                                    
                                                    foreach(Cuerpo() as $cp7){


                                                        if($cp7['ID'] >= 95 && $cp7['ID'] <= 110){

                                                            $sumaAcumul7=0;

                                                            

                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp7['Concep'].'</td>
                                                                    ';


                                                            foreach($rangofech1 as $mesregi){
                                                            

                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES']; 



                                                            /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                            $informe7 = "SELECT SUM(".$cp7['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ AS JD, DUQUESA..TBL_RINFORME_JUNTA_DUQ2 AS JD2 WHERE JD.INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio' AND JD2.INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio'";

                                                            //echo $informe;
                                                            $consulinforme7=odbc_exec($conexion, $informe7);

                                                            $campos7 = odbc_result($consulinforme7, 'resultado');

                                                            /* if($fechaInicio == $fechaFinal){

                                                                $sumaAcumul7 = $sumaAcumul7 + $campos7;

                                                            }  */

                                                            if($cp7['ID']==107 && $cp7['campo']=='(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';
                                                                
                                                            }elseif($cp7['ID']==109 && $cp7['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){

                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white; ">$'.number_format($campos7,0).'</td>';

                                                            }elseif($cp7['ID']==95 && $cp7['campo']=='(ACEITES2/TON_ACEITES)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                            }elseif($cp7['ID']==96 && $cp7['campo']=='(((ACEITES2/TON_ACEITES)/(ACEITES/TON_ACEITES))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                            }elseif($cp7['ID']==97 && $cp7['campo']=='(MARGARINAS2/TON_MARGARINAS)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                            }elseif($cp7['ID']==98 && $cp7['campo']=='(((MARGARINAS2/TON_MARGARINAS)/(MARGARINAS/TON_MARGARINAS))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                            }elseif($cp7['ID']==99 && $cp7['campo']=='(SOLIDOS_CREMOSOS2/TON_SOLIDOS_CREMOSOS)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                            }elseif($cp7['ID']==100 && $cp7['campo']=='(((SOLIDOS_CREMOSOS2/TON_SOLIDOS_CREMOSOS)/(SOLIDOS_CREMOSOS/TON_SOLIDOS_CREMOSOS))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                            }elseif($cp7['ID']==101 && $cp7['campo']=='(INDUSTRIALES2/TON_INDUSTRIALES_OLEO)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                            }elseif($cp7['ID']==102 && $cp7['campo']=='(((INDUSTRIALES2/TON_INDUSTRIALES_OLEO)/(INDUSTRIALES/TON_INDUSTRIALES_OLEO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                            }elseif($cp7['ID']==103 && $cp7['campo']=='(ACIDOS_GRASOS_ACIDULADO2/TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                            }elseif($cp7['ID']==104 && $cp7['campo']=='(((ACIDOS_GRASOS_ACIDULADO2/TON_ACIDOS_GRASOS_ACIDULADO)/(ACIDOS_GRASOS_ACIDULADO/TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                            }elseif($cp7['ID']==105 && $cp7['campo']=='(SERVICIO_MAQUILA2/TON_SERVICIO_MAQUILA)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($campos7,0).'</td>';

                                                            }elseif($cp7['ID']==106 && $cp7['campo']=='(((SERVICIO_MAQUILA2/TON_SERVICIO_MAQUILA)/(SERVICIO_MAQUILA/TON_SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                            }elseif($cp7['ID']==108 && $cp7['campo']=='((((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                            }elseif($cp7['ID']==110 && $cp7['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($campos7,1).'%'.'</td>';

                                                            }


                                                            if($cp7['ID']!=107 && $cp7['ID']!=109 && $cp7['ID']!=95 && $cp7['ID']!=96 && $cp7['ID']!=97 && $cp7['ID']!=98 && $cp7['ID']!=99 && $cp7['ID']!=100 && $cp7['ID']!=101 && $cp7['ID']!=102 && $cp7['ID']!=103 && $cp7['ID']!=104 && $cp7['ID']!=105 && $cp7['ID']!=106 && $cp7['ID']!=108 && $cp7['ID']!=110 ) {

                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white; ">$'.number_format($campos7,0).'</td>';    

                                                            }

                                                        
                                                            
                                                            
                                                            }                                                                                   


                                                        

                                                            /* if($sumaAcumul7 == 0){

                                                                $promedio = 0;
                                                            }else{

                                                                $promedio = $sumaAcumul7 / count($rangofech);
                                                            }

                                                            if($cp7['ID']==107 && $cp7['campo']=='(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';
                                                                
                                                            }elseif($cp7['ID']==109 && $cp7['campo']=='(((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){

                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';
                                                            }elseif($cp7['ID']==95 && $cp7['campo']=='(ACEITES2/TON_ACEITES)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp7['ID']==96 && $cp7['campo']=='(((ACEITES2/TON_ACEITES)/(ACEITES/TON_ACEITES))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp7['ID']==97 && $cp7['campo']=='(MARGARINAS2/TON_MARGARINAS)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp7['ID']==98 && $cp7['campo']=='(((MARGARINAS2/TON_MARGARINAS)/(MARGARINAS/TON_MARGARINAS))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp7['ID']==99 && $cp7['campo']=='(SOLIDOS_CREMOSOS2/TON_SOLIDOS_CREMOSOS)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp7['ID']==100 && $cp7['campo']=='(((SOLIDOS_CREMOSOS2/TON_SOLIDOS_CREMOSOS)/(SOLIDOS_CREMOSOS/TON_SOLIDOS_CREMOSOS))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp7['ID']==101 && $cp7['campo']=='(INDUSTRIALES2/TON_INDUSTRIALES_OLEO)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp7['ID']==102 && $cp7['campo']=='(((INDUSTRIALES2/TON_INDUSTRIALES_OLEO)/(INDUSTRIALES/TON_INDUSTRIALES_OLEO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp7['ID']==103 && $cp7['campo']=='(ACIDOS_GRASOS_ACIDULADO2/TON_ACIDOS_GRASOS_ACIDULADO)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp7['ID']==104 && $cp7['campo']=='(((ACIDOS_GRASOS_ACIDULADO2/TON_ACIDOS_GRASOS_ACIDULADO)/(ACIDOS_GRASOS_ACIDULADO/TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp7['ID']==105 && $cp7['campo']=='(SERVICIO_MAQUILA2/TON_SERVICIO_MAQUILA)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp7['ID']==106 && $cp7['campo']=='(((SERVICIO_MAQUILA2/TON_SERVICIO_MAQUILA)/(SERVICIO_MAQUILA/TON_SERVICIO_MAQUILA))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp7['ID']==108 && $cp7['campo']=='((((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp7['ID']==110 && $cp7['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($sumaAcumul7,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">'.number_format($promedio,0).'%'.'</td>';

                                                            }

                                                            if($cp7['ID']!=107 && $cp7['ID']!=109 && $cp7['ID']!=95 && $cp7['ID']!=96 && $cp7['ID']!=97 && $cp7['ID']!=98 && $cp7['ID']!=99 && $cp7['ID']!=100 && $cp7['ID']!=101 && $cp7['ID']!=102 && $cp7['ID']!=103 && $cp7['ID']!=104 && $cp7['ID']!=105 && $cp7['ID']!=106 && $cp7['ID']!=108 && $cp7['ID']!=110) {

                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($sumaAcumul7,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 300px; background:white;">$'.number_format($promedio,0).'</td>';
                                                            } */

                                                        

                                                            echo'</tr>';

                                                        }

                                                        

                                                    }
                                                    ?>

                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                        <?php    
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- GASTOS OPERACIONALES -->

                            <div class="card mb-4">

                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#GastosOperacionales2" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-credit-card me-1"></i>
                                    <b>GASTOS OPERACIONALES <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="card-body collapse" id="GastosOperacionales2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id="" border="1" class="table m-b-0 table-hover">
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    foreach($rangofech1 as $rangomeses){

                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:#E6B8B7">
                                                            '.$trimes.' </th>'; 

                                                        }

                                                        
                                                    }
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px;">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px;">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >

                                                    

                                                    <?php
                                                    
                                                    
                                                    foreach(Cuerpo() as $cp8){


                                                        if($cp8['ID'] >= 111 && $cp8['ID'] <= 144){

                                                            $sumaAcumul8=0;

                                                            

                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp8['Concep'].'</td>
                                                                    ';


                                                            foreach($rangofech1 as $mesregi){
                                                            

                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES'];



                                                            /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                            $informe8 = "SELECT SUM(".$cp8['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ AS JD, DUQUESA..TBL_RINFORME_JUNTA_DUQ2 AS JD2 WHERE JD.INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio' AND JD2.INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio'";

                                                            //echo $informe;
                                                            $consulinforme8=odbc_exec($conexion, $informe8);

                                                            $campos8 = odbc_result($consulinforme8, 'resultado');

                                                           /*  if($fechaInicio == $fechaFinal){

                                                                $sumaAcumul8 = $sumaAcumul8 + $campos8;

                                                            }  */

                                                            if($cp8['ID']==111 && $cp8['campo']=='(GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white;">$'.number_format($campos8,0).'</td>';
                                                                
                                                            }elseif($cp8['ID']==121 && $cp8['campo']=='(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==139 && $cp8['campo']=='(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==141 && $cp8['campo']=='((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==143 && $cp8['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==112 && $cp8['campo']=='((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==113 && $cp8['campo']=='(GASTOS_PERSONAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white;  ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==114 && $cp8['campo']=='((GASTOS_PERSONAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==115 && $cp8['campo']=='(HONORARIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==116 && $cp8['campo']=='((HONORARIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==117 && $cp8['campo']=='(SERVICIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==118 && $cp8['campo']=='((SERVICIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==119 && $cp8['campo']=='((GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==120 && $cp8['campo']=='(((GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==122 && $cp8['campo']=='((GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==123 && $cp8['campo']=='(GASTOS_PERSONAL2/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==124 && $cp8['campo']=='((GASTOS_PERSONAL2/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==125 && $cp8['campo']=='(POLIZA_CARTERA/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==126 && $cp8['campo']=='((POLIZA_CARTERA/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==127 && $cp8['campo']=='(FLETES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==128 && $cp8['campo']=='((FLETES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==129 && $cp8['campo']=='(SERVICIO_LOGISTICO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==130 && $cp8['campo']=='((SERVICIO_LOGISTICO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==131 && $cp8['campo']=='(ESTRATEGIA_COMERCIAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==132 && $cp8['campo']=='((ESTRATEGIA_COMERCIAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==133 && $cp8['campo']=='(IMPUESTOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==134 && $cp8['campo']=='((IMPUESTOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==135 && $cp8['campo']=='(DES_PRONTO_PAGO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==136 && $cp8['campo']=='((DES_PRONTO_PAGO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white;  ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==137 && $cp8['campo']=='((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';

                                                            }elseif($cp8['ID']==138 && $cp8['campo']=='(((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==140 && $cp8['campo']=='((DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==142 && $cp8['campo']=='(((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }elseif($cp8['ID']==144 && $cp8['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($campos8,1).'%'.'</td>';

                                                            }


                                                            if($cp8['ID']!=111 && $cp8['ID']!=121 && $cp8['ID']!=139  && $cp8['ID']!=141 && $cp8['ID']!=143  && $cp8['ID']!=112  && $cp8['ID']!=113  && $cp8['ID']!=114  && $cp8['ID']!=115  && $cp8['ID']!=116  && $cp8['ID']!=117  && $cp8['ID']!=118  && $cp8['ID']!=119  && $cp8['ID']!=120  && $cp8['ID']!=122  && $cp8['ID']!=123  && $cp8['ID']!=124  && $cp8['ID']!=125  && $cp8['ID']!=126  && $cp8['ID']!=127  && $cp8['ID']!=128  && $cp8['ID']!=129  && $cp8['ID']!=130  && $cp8['ID']!=131  && $cp8['ID']!=132  && $cp8['ID']!=133  && $cp8['ID']!=134  && $cp8['ID']!=135  && $cp8['ID']!=136  && $cp8['ID']!=137  && $cp8['ID']!=138  && $cp8['ID']!=140  && $cp8['ID']!=142  && $cp8['ID']!=144) {

                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($campos8,0).'</td>';    

                                                            }

                                                        
                                                            
                                                            
                                                            }                                                                                   


                                                        

                                                            /* if($sumaAcumul8 == 0){

                                                                $promedio = 0;
                                                            }else{

                                                                $promedio = $sumaAcumul8 / count($rangofech);
                                                            }

                                                            if($cp8['ID']==111 && $cp8['campo']=='(GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                                
                                                            }elseif($cp8['ID']==121 && $cp8['campo']=='(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){

                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==139 && $cp8['campo']=='(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==141 && $cp8['campo']=='((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==143 && $cp8['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==112 && $cp8['campo']=='((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==113 && $cp8['campo']=='(GASTOS_PERSONAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==114 && $cp8['campo']=='((GASTOS_PERSONAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==115 && $cp8['campo']=='(HONORARIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==116 && $cp8['campo']=='((HONORARIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==117 && $cp8['campo']=='(SERVICIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==118 && $cp8['campo']=='((SERVICIOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==119 && $cp8['campo']=='((GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==120 && $cp8['campo']=='(((GASTOS_ADMINISTRACION-GASTOS_PERSONAL-HONORARIOS-SERVICIOS)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==122 && $cp8['campo']=='((GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==123 && $cp8['campo']=='(GASTOS_PERSONAL2/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==124 && $cp8['campo']=='((GASTOS_PERSONAL2/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==125 && $cp8['campo']=='(POLIZA_CARTERA/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==126 && $cp8['campo']=='((POLIZA_CARTERA/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==127 && $cp8['campo']=='(FLETES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==128 && $cp8['campo']=='((FLETES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==129 && $cp8['campo']=='(SERVICIO_LOGISTICO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==130 && $cp8['campo']=='((SERVICIO_LOGISTICO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==131 && $cp8['campo']=='(ESTRATEGIA_COMERCIAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==132 && $cp8['campo']=='((ESTRATEGIA_COMERCIAL/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==133 && $cp8['campo']=='(IMPUESTOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==134 && $cp8['campo']=='((IMPUESTOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==135 && $cp8['campo']=='(DES_PRONTO_PAGO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==136 && $cp8['campo']=='((DES_PRONTO_PAGO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==137 && $cp8['campo']=='((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp8['ID']==138 && $cp8['campo']=='(((GASTOS_VENTAS-GASTOS_PERSONAL2-POLIZA_CARTERA-FLETES-SERVICIO_LOGISTICO-ESTRATEGIA_COMERCIAL-IMPUESTOS-DES_PRONTO_PAGO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==140 && $cp8['campo']=='((DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==142 && $cp8['campo']=='(((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp8['ID']==144 && $cp8['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($sumaAcumul8,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }


                                                            if($cp8['ID']!=111 && $cp8['ID']!=121 && $cp8['ID']!=139  && $cp8['ID']!=141 && $cp8['ID']!=143  && $cp8['ID']!=112  && $cp8['ID']!=113  && $cp8['ID']!=114  && $cp8['ID']!=115  && $cp8['ID']!=116  && $cp8['ID']!=117  && $cp8['ID']!=118  && $cp8['ID']!=119  && $cp8['ID']!=120  && $cp8['ID']!=122  && $cp8['ID']!=123  && $cp8['ID']!=124  && $cp8['ID']!=125  && $cp8['ID']!=126  && $cp8['ID']!=127  && $cp8['ID']!=128  && $cp8['ID']!=129  && $cp8['ID']!=130  && $cp8['ID']!=131  && $cp8['ID']!=132  && $cp8['ID']!=133  && $cp8['ID']!=134  && $cp8['ID']!=135  && $cp8['ID']!=136  && $cp8['ID']!=137  && $cp8['ID']!=138  && $cp8['ID']!=140  && $cp8['ID']!=142  && $cp8['ID']!=144) {

                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($sumaAcumul8,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 385px; background:white; ">$'.number_format($promedio,0).'</td>';
                                                            } */

                                                        

                                                            echo'</tr>';

                                                        }

                                                        

                                                    }
                                                    ?>

                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                        <?php    
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- GASTOS NO OPERACIONALES -->

                            <div class="card mb-4">

                                <div class="card-header sb-sidenav-collapse-arrow" href="#" data-bs-toggle="collapse" data-bs-target="#GastosNoOperacionales2" aria-expanded="false" aria-controls="collapseLayouts">
                                    <i class="fas fa-shopping-bag me-1"></i>
                                    <b>GASTOS NO OPERACIONALES <?php echo $anioHoy; ?></b>
                                    <i class="fas fa-angle-down"></i>
                                </div>

                                <div class="card-body collapse" id="GastosNoOperacionales2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                    
                                    <br>
                                    <?php
                                    if($estadosConsulta == 1){?>
                                    <div class="table-responsive">
                                        <table id="" border="1"  class="table m-b-0 table-hover" >
                                            <thead class="thead-color">
                                                <tr>
                                                    
                                                    <th style="text-align: center; position: -webkit-sticky; white-space: nowrap; position: sticky; left:0px;"> CONCEPTO </th>
                                                    <?php
                                                    foreach($rangofech1 as $rangomeses){

                                                        $fechaInicio = $rangomeses['FechaI'];
                                                        $fechaFinal = $rangomeses['FechaF'];
                                                        $trimes = 'TRIMESTRE';

                                                        if($fechaInicio == $fechaFinal){

                                                            $mes = substr($fechaInicio,5,2);

                                                            $anio = substr($fechaInicio,0,4);

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7">
                                                            '.NombreMeses($mes).' '.$anio.' </th>'; 

                                                        }else{

                                                            echo'<th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:#E6B8B7">
                                                            '.$trimes.' </th>'; 

                                                        }

                                                        
                                                    }
                                                    
                                                    ?>
                                                
                                                    <!-- <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px;">ACUMULADO</th>
                                                    <th style="text-align: center; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px;">PROMEDIO</th> -->
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody >

                                                    

                                                    <?php
                                                    
                                                    
                                                    foreach(Cuerpo() as $cp9){


                                                        if($cp9['ID'] >= 145 && $cp9['ID'] <= 158){

                                                            $sumaAcumul9=0;

                                                            

                                                            echo '<tr>
                                                                    <td style="text-align: left; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 0px; background:white;">'.$cp9['Concep'].'</td>
                                                                    ';


                                                            foreach($rangofech1 as $mesregi){
                                                            

                                                                $fechaInicio = $mesregi['FechaI'];
                                                                $fechaFinal = $mesregi['FechaF'];
                                                                $Meses1 = $mesregi['CODMES'];



                                                            /* $informe = "EXEC [SPR_GET_VENTAS_NETAS] '$periodo','$Meses','$N1','$N2'"; */
                                                            $informe9 = "SELECT SUM(".$cp9['campo'].") AS resultado  FROM DUQUESA..TBL_RINFORME_JUNTA_DUQ AS JD, DUQUESA..TBL_RINFORME_JUNTA_DUQ2 AS JD2 WHERE JD.INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio' AND JD2.INF_D_FECHAS BETWEEN '$fechaInicio' AND '$fechaInicio'";

                                                            //echo $informe;
                                                            $consulinforme9=odbc_exec($conexion, $informe9);

                                                            $campos9 = odbc_result($consulinforme9, 'resultado');

                                                            /* if($fechaInicio == $fechaFinal){

                                                                $sumaAcumul9 = $sumaAcumul9 + $campos9;

                                                            }  */

                                                            if($cp9['ID']==153 && $cp9['campo']=='((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';
                                                                
                                                            }elseif($cp9['ID']==155 && $cp9['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))-((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))'){

                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                            }elseif($cp9['ID']==157 && $cp9['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                            }elseif($cp9['ID']==145 && $cp9['campo']=='(FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                            }elseif($cp9['ID']==146 && $cp9['campo']=='((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                            }elseif($cp9['ID']==147 && $cp9['campo']=='(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                            }elseif($cp9['ID']==148 && $cp9['campo']=='((RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                            }elseif($cp9['ID']==149 && $cp9['campo']=='(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                            }elseif($cp9['ID']==150 && $cp9['campo']=='((GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                            }elseif($cp9['ID']==151 && $cp9['campo']=='((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';

                                                            }elseif($cp9['ID']==152 && $cp9['campo']=='(((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                            }elseif($cp9['ID']==154 && $cp9['campo']=='(((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                            }elseif($cp9['ID']==156 && $cp9['campo']=='((((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))-((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                            }elseif($cp9['ID']==158 && $cp9['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td id="fecha" style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($campos9,1).'%'.'</td>';

                                                            }


                                                            if($cp9['ID']!=153 && $cp9['ID']!=155 && $cp9['ID']!=157  && $cp9['ID']!=145 && $cp9['ID']!=146  && $cp9['ID']!=147  && $cp9['ID']!=148  && $cp9['ID']!=149  && $cp9['ID']!=150  && $cp9['ID']!=151  && $cp9['ID']!=152  && $cp9['ID']!=154  && $cp9['ID']!=156  && $cp9['ID']!=158) {

                                                                echo '<td id="fecha" style="text-align: right;  position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($campos9,0).'</td>';    

                                                            }

                                                        
                                                            
                                                            
                                                            }                                                                                   


                                                        

                                                            /* if($sumaAcumul9 == 0){

                                                                $promedio = 0;
                                                            }else{

                                                                $promedio = $sumaAcumul9 / count($rangofech);
                                                            }

                                                            if($cp9['ID']==153 && $cp9['campo']=='((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp9['ID']==155 && $cp9['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))-((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))'){

                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp9['ID']==157 && $cp9['campo']=='((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                                echo '<td style="text-align: right; font-weight:bold; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp9['ID']==145 && $cp9['campo']=='(FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp9['ID']==146 && $cp9['campo']=='((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp9['ID']==147 && $cp9['campo']=='(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp9['ID']==148 && $cp9['campo']=='((RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp9['ID']==149 && $cp9['campo']=='(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp9['ID']==150 && $cp9['campo']=='((GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp9['ID']==151 && $cp9['campo']=='((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            }elseif($cp9['ID']==152 && $cp9['campo']=='(((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,0).'%'.'</td>';
                                                                echo '<td style="text-align: right;">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp9['ID']==154 && $cp9['campo']=='(((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp9['ID']==156 && $cp9['campo']=='((((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))-(((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+SERVICIO_MAQUILA2+SERVICIO_MAQUILA2))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO)))-((GASTOS_ADMINISTRACION/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GASTOS_VENTAS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(DEPRECIACIONES_AMORTIZACIONES/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))-((FINANCIEROS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(RETIRO_ACTIVOS/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+(GRAVA_MOV_FINANCIERO/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))+((OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO)/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }elseif($cp9['ID']==158 && $cp9['campo']=='(((((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-((ACEITES2+MARGARINAS2+SOLIDOS_CREMOSOS2)+(INDUSTRIALES2+ACIDOS_GRASOS_ACIDULADO2+SERVICIO_MAQUILA2))-((GASTOS_ADMINISTRACION+GASTOS_VENTAS+DEPRECIACIONES_AMORTIZACIONES)))-(((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))))+((FINANCIEROS+RETIRO_ACTIVOS+GRAVA_MOV_FINANCIERO)+(OTROS-FINANCIEROS-RETIRO_ACTIVOS-GRAVA_MOV_FINANCIERO))+(DEPRECIACIONES_AMORTIZACIONES+EBITDA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))/((((ACEITES+MARGARINAS+SOLIDOS_CREMOSOS)+(INDUSTRIALES+ACIDOS_GRASOS_ACIDULADO+SERVICIO_MAQUILA))-(SERVICIO_MAQUILA))/(TON_ACEITES+TON_MARGARINAS+TON_SOLIDOS_CREMOSOS+TON_INDUSTRIALES_OLEO+TON_ACIDOS_GRASOS_ACIDULADO))*100)'){
                                                                
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($sumaAcumul9,0).'%'.'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">'.number_format($promedio,0).'%'.'</td>';

                                                            }


                                                            if($cp9['ID']!=153 && $cp9['ID']!=155 && $cp9['ID']!=157  && $cp9['ID']!=145 && $cp9['ID']!=146  && $cp9['ID']!=147  && $cp9['ID']!=148  && $cp9['ID']!=149  && $cp9['ID']!=150  && $cp9['ID']!=151  && $cp9['ID']!=152  && $cp9['ID']!=154  && $cp9['ID']!=156  && $cp9['ID']!=158) {

                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($sumaAcumul9,0).'</td>';
                                                                echo '<td style="text-align: right; position: -webkit-sticky;  white-space: nowrap; position: sticky; left: 420px; background:white; ">$'.number_format($promedio,0).'</td>';

                                                            } */
                                                        

                                                            echo'</tr>';

                                                        }

                                                        

                                                    }
                                                    ?>

                                                                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                        <?php    
                                        }
                                    ?>
                                </div>
                            </div>


                                
                            <?php    
                            
                            
                            ?> 

                          

                        <?php
                        }
                        ?>
                        
                         
                    </div>
                </main>

                <div class="modal fade" id="Partidas" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Partidas Mes Actual</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            
                            <div class="card-body table-responsive">

                                <table border="1" class="table m-b-0 table-hover">
                                    <thead class="thead" style="background-color:#E6B8B7">
                                        <tr>
                                            <th hidden="hidden" style="text-align:center;">ID</th>   
                                            <th style="text-align:center;">Fecha</th>
                                            <th style="text-align:center;">Partidas</th>
                                            <th style="text-align:center;">Cantidad</th>
                                            <th style="text-align:center;">Nueva Cantidad</th>
                                            <th style="text-align:center;">Actualizar</th>                                            
                                                                            

                                        </tr>
                                    </thead>
                                    
                                    <tbody id="table-tbody-supervisor-descargas-post" class="tbody">

                                        <?php

                                        $partidura ="SELECT PAR_NID, PAR_CPARTIDURA, PAR_CCANTIDAD, PAR_D_FECHA_REGISTRO, PAR_CESTADO
                                        FROM DUQUESA..TBL_RPARTIDURAS_JUNTA_DUQ WHERE YEAR(PAR_DFECHA)= YEAR(GETDATE()) AND 
                                        MONTH(PAR_DFECHA) = MONTH(GETDATE()) AND PAR_CESTADO = 1 ORDER BY PAR_CPARTIDURA ";

                                        $consulpartidura=odbc_exec($conexion, $partidura);

                                        while($resultado = odbc_fetch_array($consulpartidura)){

                                            $PAR_NID = $resultado['PAR_NID'];
                                            $PAR_CPARTIDURA = $resultado['PAR_CPARTIDURA'];
                                            $PAR_CCANTIDAD = $resultado['PAR_CCANTIDAD'];
                                            $PAR_D_FECHA_REGISTRO =$resultado['PAR_D_FECHA_REGISTRO'];
                                            $PAR_CESTADO = $resultado['PAR_CESTADO']; ?>





                                        
                                        <form action="actualizar_partidura.php" method="post">
                                        <tr>
                                            <td hidden="hidden"><input hidden="hideen" name="id_nuevo" type="text" value="<?php echo $PAR_NID; ?>"></td>
                                            <td style="padding-top: 20px; text-align:center;"><?php echo $PAR_D_FECHA_REGISTRO;?></td>
                                            <td style="padding-top: 20px; text-align:center;"><?php echo $PAR_CPARTIDURA;?></td>
                                            <td><input disabled type="float" name="Cantidad" class="form-control" value="<?php echo number_format($PAR_CCANTIDAD,1)?>" style ="text-align: center;"></td>
                                            <td><input  type="float" name="nuevaCantidad" class="form-control" style ="text-align: center;"></td>
                                            <td style="text-align:center"><button type="submit" class="btn btn-link" id="enviar" name="enviar"><img src="img/actualizar.png" alt="actualiza_icono"></button></td>
                                            
                                        </tr>
                                                    
                                        </form>
                                                    
                                        
                                        <?php
                                        }

                                        ?>

                                        
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="modal-footer">                            
                            <button class="btn btn-danger" data-bs-target="#Partiduras" data-bs-toggle="modal" data-bs-dismiss="modal">Ir Actualizar Todas Las Partidas</button>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="Partiduras" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Actualizar Partidas</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="card-body" style="margin-top: -30px" >
                                
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                                        <div class="form-group">

                                            <?php
                                                
                                                $consultarPartidura = 0;

                                                if(isset($_POST['partidura'])){


                                                    $InicioFE = $_POST['InicioFe'];
                                                    $FinalFE = $_POST['FinalFe'];

                                                    $consultarPartidura ++;


                                                }
                                            ?>



                                            
                                            <form method="POST">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="" style="margin-top:20px;" ><b>Fecha Inicio: <?php echo $InicioFE; ?></b></label><br><br>                                                    
                                                        <input required type="date" class="form-control"  name="InicioFe" id="InicioFe1"  >
                                                    </div> 
                                                    
                                                    <div class="col-md-4">
                                                        <label for="" style="margin-top:20px;"><b>Fecha Fin: <?php echo $FinalFE; ?></b></label><br><br>
                                                        <input required type="date" class="form-control"  name="FinalFe" id="FinalFe1"  >
                                                    </div> 
                                                   
                                                    <div class="col-md-3">
                                                        <button type="submit" class="btn btn-danger"  name="partidura" id="partidura" style="margin-block-start: 67px; margin-left: 8px;">
                                                        
                                                        <b>Consultar</b></button>

                                                    </div>
                                                </div> 
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            

                            </div>

                            <div class="card-body table-responsive">

                                <?php if($consultarPartidura ==1){

                                ?>
                                <table border="1" class="table m-b-0 table-hover">
                                    <thead class="thead" style="background-color:#E6B8B7">
                                        <tr>
                                            <th hidden="hidden" style="text-align:center;">ID</th>   
                                            <th style="text-align:center;">Fecha</th>
                                            <th style="text-align:center;">Partidas</th>
                                            <th style="text-align:center;">Cantidad</th>
                                            <th style="text-align:center;">Nueva Cantidad</th>
                                            <th style="text-align:center;">Actualizar</th>                                            
                                                                            

                                        </tr>
                                    </thead>
                                    
                                    <tbody id="table-tbody-supervisor-descargas-post" class="tbody">

                                        <?php

                                        $partidura ="SELECT PAR_NID, PAR_CPARTIDURA, PAR_CCANTIDAD, PAR_D_FECHA_REGISTRO, PAR_CESTADO,PAR_DFECHA
                                        FROM DUQUESA..TBL_RPARTIDURAS_JUNTA_DUQ WHERE  PAR_CESTADO = 1 AND (PAR_DFECHA) between 
                                        '$InicioFE'  AND  '$FinalFE' ORDER BY PAR_DFECHA ";

                                        /* $partidura ="SELECT PAR_NID, PAR_CPARTIDURA, PAR_CCANTIDAD, PAR_D_FECHA_REGISTRO, PAR_CESTADO
                                        FROM DUQUESA..TBL_RPARTIDURAS_JUNTA_DUQ WHERE YEAR(PAR_D_FECHA_REGISTRO)= YEAR(GETDATE()) AND 
                                        MONTH(PAR_D_FECHA_REGISTRO) = MONTH(GETDATE()) AND PAR_CESTADO = 1 ORDER BY PAR_CPARTIDURA "; */

                                        $consulpartidura=odbc_exec($conexion, $partidura);

                                        while($resultado = odbc_fetch_array($consulpartidura)){

                                            $PAR_NID = $resultado['PAR_NID'];
                                            $PAR_CPARTIDURA = $resultado['PAR_CPARTIDURA'];
                                            $PAR_CCANTIDAD = $resultado['PAR_CCANTIDAD'];
                                            $PAR_DFECHA =$resultado['PAR_DFECHA'];
                                            $PAR_CESTADO = $resultado['PAR_CESTADO']; ?>





                                        
                                        <form action="actualizar_partidura.php" method="post">
                                        <tr>
                                            <td hidden="hidden"><input hidden="hideen" name="id_nuevo" type="text" value="<?php echo $PAR_NID; ?>"></td>
                                            <td style="padding-top: 20px; text-align:center;"><?php echo $PAR_DFECHA;?></td>
                                            <td style="padding-top: 20px; text-align:center;"><?php echo $PAR_CPARTIDURA;?></td>
                                            <td><input disabled type="namber" name="Cantidad" class="form-control" value="<?php echo number_format($PAR_CCANTIDAD,1);?>" style ="text-align: center;"></td>
                                            <td><input  type="float" name="nuevaCantidad" class="form-control" style ="text-align: center;"></td>
                                            <td style="text-align:center"><button type="submit" class="btn btn-link" id="enviar" name="enviar"><img src="img/actualizar.png" alt="actualiza_icono"></button></td>
                                            
                                        </tr>
                                                    
                                        </form>
                                                    
                                        
                                        <?php
                                        }

                                        ?>

                                        
                                        
                                    </tbody>
                                </table>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="margin-top: 140px;" >Volver Partidas Mes Actual</button>
                            
                        </div>
                        </div>
                    </div>
                </div>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Desarrollado by Sistemas Duquesa 2022 Privacy Policy Terms & Conditions</div>
                            
                        </div>
                    </div>
                </footer>
            </div>
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


