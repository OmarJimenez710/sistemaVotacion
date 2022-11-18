<?php
    $variable = 50;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Recursos iconos -->
    <link rel="stylesheet" href="../../Recursos/fontawesome-free-6.2.0-web/css/all.css">

    <!--Google Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Bootstrap --> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- Estilos propios -->
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <!-- Barra de navegacion -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid text-center">
            <a class="navbar-brand">

            <!-- ACTUALIZACION para que se vea foto y nombre del administrador  -->
            <?php
                $conexion = mysqli_connect("localhost","root","");
                mysqli_select_db($conexion, "sistema_votacion");

                session_start();
                $id_administrador = $_SESSION['administrador'];

                $consultaAdmin = mysqli_query($conexion,"SELECT nombre_administrador, apellido_paternoAdministrador, dir_foto FROM administrador WHERE id_administrador = '$id_administrador'");
                
                $datosAdmin = mysqli_fetch_array($consultaAdmin);


                echo "<img class='img-fluid text-center' src = '.$datosAdmin[2].' style='width: 50px; height: 50px; border-radius: 50%;'>";
                echo "<h6> $datosAdmin[0]  $datosAdmin[1] </h6>";
            ?>

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="administracion.php"> <i class="fa-solid fa-house"></i> Inicio </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-screwdriver-wrench"></i> Configuraciones
                        </a>
                        <ul class="dropdown-menu text-center">
                            <form action="" method="POST">
                                <button class="btn btn-primary mb-1" name = "a_alumnos" style="width: 80%;"> <i class="fa-sharp fa-solid fa-graduation-cap"></i> Alumnos </button>
                                <button class="btn btn-primary" name = "a_candidatos" style="width: 80%;"> <i class="fa-solid fa-people-group"></i> Candidatos </button>
                            </form>
                        </ul>
                    </li>
                    <!-- Actualizacion
                    <li class="nav-item">
                        <a class="nav-link" href="#"> <i class="fa-solid fa-users"></i> Nosotros </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="Ayuda.html"> <i class="fa-solid fa-handshake-angle"></i> Ayuda </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cerrarSession.php"> <i class="fa-solid fa-right-from-bracket"></i> Salir </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <!-- ACTUALIZACION
            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 text-center" style="margin: auto;">
                <div class="grafica scrollable">
                    <div id="piechart_3d"></div>
                </div>
            </div>  -->
            
    <!-- Form modal para el Alta de alumnos -->
    <div class="modal fade" id="exampleModalAlta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alta de alumno </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="alta_nombre" class="form-control" placeholder="Nombre(s) del alumno" autofocus required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="alta_apellidoP" class="form-control" placeholder="Apellido paterno" autofocus required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="alta_apellidoM" class="form-control" placeholder="Apellido materno" autofocus required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="alta_correo" class="form-control" placeholder="Correo electrónico" autofocus required>
                    </div>
                    <div class="mb-3">
                        <input type="numeber" name="alta_numCuenta" class="form-control" placeholder="Número de cuenta" autofocus required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="alta_contra" class="form-control" placeholder="Contraseña" autofocus required>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-success" name="postAlta" value="Registrar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div> 
                </form>
            </div>
            </div>
        </div>
    </div>


    <!-- Form modal para el Baja de alumnos -->
    <div class="modal fade" id="exampleModalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Baja de alumno </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="baja_numCuenta" class="form-control" placeholder="Numero de cuenta" autofocus>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-danger" name="postBaja" value="Eliminar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div> 
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Form modal para el Busqueda de alumnos -->
    <div class="modal fade" id="exampleModalBuscar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Busqueda de alumno </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="busqueda_alumno" class="form-control" placeholder="Numero de cuenta" autofocus>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-info" name="postBusqueda" value="Buscar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div> 
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- =========================================================================================== -->

    <!-- Form modal para el Alta de Candidatos -->
    <div class="modal fade" id="exampleModalAltaCandi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alta de candidato </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="alta_nombreCandi" class="form-control" placeholder="Nombre completo" autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="alta_partidoCandi" class="form-control" placeholder="Nombre del partido" autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="alta_imagenCandi" class="form-control" placeholder="Nombre de la imagen" autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="alta_propuesta1" class="form-control" placeholder="Propuesta 1" autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="alta_propuesta2" class="form-control" placeholder="Propuesta 2" autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="alta_propuesta3" class="form-control" placeholder="Propuesta 3" autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="alta_propuesta4" class="form-control" placeholder="Propuesta 4" autofocus>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-success" name="postAltaCandi" value="Registrar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div> 
                </form>
            </div>
            </div>
        </div>
    </div>


    <!-- Form modal para el Baja de Candidatos  -->
    <div class="modal fade" id="exampleModalEliminarCandi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Baja de candidato </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="baja_nomCandi" class="form-control" placeholder="Nombre del candidato" autofocus>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-danger" name="postBajaCandi" value="Eliminar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div> 
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Form modal para el Busqueda de Candidatos -->
    <div class="modal fade" id="exampleModalBuscarCandi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Busqueda de candidato </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="busqueda_candidato" class="form-control" placeholder="Nombre del candidato" autofocus>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-info" name="postBusquedaCandi" value="Buscar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div> 
                </form>
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
        
    <?php
        include("../../Controladores/accionAdministrador.php");
        include("../Alumno/altaAlumno.php");
        include("../Alumno/bajaAlumno.php");
        include("../Alumno/busquedaAlumno.php");
        
        include("../Candidato/altaCandidato.php");
        include("../Candidato/bajaCandidato.php");
        include("../Candidato/busquedaCandidato.php");
    ?>
</body>
</html> 
