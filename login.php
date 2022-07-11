<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login | Informe Junta Directiva Duquesa</title>
        <link rel="icon" href="img/duquesa.ico" type="image/x-icon">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed" background="img/duquesa.jpg" >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5" style="margin-top: -35px;">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-danger"><h3 class="text-center font-weight-light my-4">Login | JD DUQUESA</h3></div>
                                    <div class="card-body">
                                        <form action="ValidaUsuarioCredencial.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" name="Usuario" id="inputUsuario" type="text" placeholder="Ingrese Usuario" style="font-weight: bold;" />
                                                <label for="inputText"><b>Ingresar Usuario</b></label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" name="Password" id="inputPassword" type="password" placeholder="Ingrese Contraseña" style="font-weight: bold;" />
                                                <label for="inputPassword"><b>Ingresar Contraseña</b></label>
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <!-- <a class="form-control btn btn-danger" href="index.php"><b>Iniciar</b></a> -->
                                                <button class="form-control btn btn-danger" type="submit" name="enviar" id="enviar1"><b>Iniciar</b></button>
                                            </div>
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
    </body>
</html>


