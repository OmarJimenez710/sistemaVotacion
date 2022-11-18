<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <!-- Css Propio -->
    <link rel="stylesheet" href="../Candidato/candidatoEstilos.css">
    
</head>
<body>
    <div class="container contenedorGeneral">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                <img class="img-fluid" src="../../Imagenes/encabezadoFI.png" alt="">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center p-3 mt-5 encabezadoEleccion">
                <h5 style="color: #fff;"> PROCESO ELECTORAL INSTITUCIONAL </h5>
                <h3 style="color: #fff;"> DIRECCIÓN  </h3>
                <h5 style="color: #fff;"> DE LA FACULTAD DE INGENIERÍA  </h5>
            </div>

    <?php
        include ("../Candidato/vistaCandidato.php");
        include("../../Controladores/previoVotoEjercido.php");
    ?>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>