<?php
  include "connexion.php";
  require 'funcion.php';
   
    date_default_timezone_set('America/Bogota');
    $fechaHoy = date('Y/m/d');
    $horaHoy = date('H:i:s');
    $anioHoy = date('Y');
    $mesHoy = date('m')-1;
    $minutoHoy = date('i');   
    
    $estadosConsulta = 0;

    if(isset($_POST['enviar'])){

        $inicio = $_POST['fechainformeInicio'];
        $final = $_POST['fechainformeFin'];
        $Meses = RangoFecha($inicio, $final);
    
        $rangofech = array_reverse($Meses);

        /* $MesesTrimestre = count($rangofech);

        echo $MesesTrimestre; */
        
        $estadosConsulta ++;

        /* $FiltroTri = FiltroTri(); */

        $stilos = Cuerpo();



    }

    /* $idcampo=4;
    $styleCampo  = Cuerpo($idcampo);

    if($styleCampo == 4){

        echo '<font style="font-weight:bold;">';

        
    } */

    /* $array_style =  array (

        'ID' => '4'.green{background: green;}.

        //'TOTAL PRODUCTO TERMINADO' => '.green{background: green;}'

    ); */
   


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
            
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Partiduras" style="margin-left:20px;">
                <b>Partiduras</b>
            </button>

            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"  style="color: white;" ><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                
                        <!-- <li><hr class="dropdown-divider" /></li> -->
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
                            <li class="breadcrumb-item active">DUQUESA S.A</li>
                        </ol>                        
                        <div class="card-body" style="margin-top: -30px" >
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        
                                        <!-- <form action="#" method="POST">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="" style="margin-left: -17px;" ><b>Fecha Inicio: <?php echo $inicio; ?></b></label><br><br>                                                    
                                                    <input required type="month" class="form-control"  name="fechainformeInicio" id="fechainformeInicio1" style="margin-left: -17px;" >
                                                </div> 
                                                
                                                <div class="col-md-3">
                                                    <label for="" style="margin-left: -8px;" ><b>Fecha Fin: <?php echo $final; ?></b></label><br><br>
                                                    <input required type="month" class="form-control"  name="fechainformeFin" id="fechainformeFin1" style="margin-left: -8px;" >
                                                </div> 
                                                
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-danger"  name="enviar" id="enviar1" style="margin-block-start: 47px; margin-left: 8px;">
                                                    
                                                    <b>Consultar</b></button>

                                                </div>
                                            </div> 
                                        </form> -->
                                    </div>
                                </div>
                            </div>
                           

                        </div>
                        <!-- Descarga de informe -->

                        <div class="card mb-4">

                            
                                                        
                            <div class="card-header">
                                <i class="fas fa-book me-1"></i>
                                <b>Descarga Informe JD Duquesa</b>
                                
                            </div>
                            
                            <div class="card-body table-responsive">
                                <table border="1" class="table m-b-0 table-hover">
                                    <thead class="thead" style="background-color:#E6B8B7">
                                        <tr>
                                            <th style="text-align:center;">Base</th>
                                            <th style="text-align:center;">Fecha Inicio</th>
                                            <th style="text-align:center;">Fecha Fin</th>                                            
                                            <th style="text-align:center;">Descargar</th>
                                            

                                        </tr>
                                    </thead>
                                    
                                    <tbody id="table-tbody-supervisor-descargas-post" class="tbody">
                                        <form action="informe_junta_directiva_duquesa.php" method="post">
                                            <tr>
                                                <td style="padding-top: 20px; text-align:center;">Base JD Duquesa</td>
                                                <td><input required type="date" name="fecha-inicio-informe" class="form-control"></td>
                                                <td><input required type="date" name="fecha-fin-informe" class="form-control"></td>
                                                <td style="text-align:center"><button type="submit" class="btn btn-link" id="buttom-informe" name="buttom-informe" ><img src="img/descargar.png" alt="icono descarga"></button></td>
                                            </tr>
                                                    
                                        </form>
                                        
                                    </tbody>
                                </table>

                            </div>
                            

                           
                        </div>
                         
                    </div>
                </main>

                <div class="modal fade" id="Partiduras" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Actualizar Partiduras</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body table-responsive">
                                <table border="1" class="table m-b-0 table-hover">
                                    <thead class="thead" style="background-color:#E6B8B7">
                                        <tr>
                                            <th hidden="hidden" style="text-align:center;">ID</th>   
                                            <th style="text-align:center;">Partidura</th>
                                            <th style="text-align:center;">Cantidad</th>
                                            <th style="text-align:center;">Nueva Cantidad</th>
                                            <th style="text-align:center;">Actualizar</th>                                            
                                                                            

                                        </tr>
                                    </thead>
                                    
                                    <tbody id="table-tbody-supervisor-descargas-post" class="tbody">

                                        <?php

                                        $partidura ="SELECT PAR_NID, PAR_CPARTIDURA, PAR_CCANTIDAD, PAR_D_FECHA_REGISTRO, PAR_CESTADO
                                        FROM DUQUESA..TBL_RPARTIDURAS_JUNTA_DUQ WHERE YEAR(PAR_D_FECHA_REGISTRO)= YEAR(GETDATE()) AND 
                                        MONTH(PAR_D_FECHA_REGISTRO) = MONTH(GETDATE()) AND PAR_CESTADO = 1";

                                        $consulpartidura=odbc_exec($conexion, $partidura);

                                        while($resultado = odbc_fetch_array($consulpartidura)){

                                            $PAR_NID = $resultado['PAR_NID'];
                                            $PAR_CPARTIDURA = $resultado['PAR_CPARTIDURA'];
                                            $PAR_CCANTIDAD = $resultado['PAR_CCANTIDAD'];
                                            $PAR_D_FECHA_REGISTRO =$resultado['PAR_D_FECHA_REGISTRO'];
                                            $PAR_CESTADO = $resultado['PAR_CESTADO']; ?>





                                        <form action="actualizar_partidura.php" method="post">
                                        <tr>
                                            <td hidden="hidden"><?php echo $PAR_NID; ?></td>
                                            <td style="padding-top: 20px; text-align:center;"><?php echo $PAR_CPARTIDURA;?></td>
                                            <td><input disabled type="text" name="Cantidad" class="form-control" value="<?php echo round($PAR_CCANTIDAD);?>" style ="text-align: center;"></td>
                                            <td><input  type="text" name="Cantidad" class="form-control" style ="text-align: center;"></td>
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
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            
                        </div>
                        </div>
                    </div>
                </div>
                <!-- <script> alert("Consulta Finalizada") </script> -->
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
<script>
    $(document).ready(function() {
    $(".spinner-border").hide(); 
    
    $('#enviar1').click(function(e){
        e.preventDefault();

        
            $('#enviar1').removeClass('btn-danger');
            $('#enviar1').addClass('btn-danger');
            $("#enviar1").attr('disabled',true); 
            $(".spinner-border").show();    

        
    });

    });
</script>