<?php
    $mysqli = new mysqli("localhost","root","","sistema_votacion");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Inicio </title>
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"> 
    <!-- Custome estilos -->
	<link rel="stylesheet" href="estilosPrincipal.css"> 
</head>
<body class="m-0 vh-100 row justify-content-center align-items-center">
    <div class="container nuevo">
        <div class="row panelPrincipal">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 panelSecundario text-center my-5">
                <img class="img-fluid my-5" src="Imagenes/encabezadoPrincipal.png" alt="">
                <h4 style="color: #fff;"> Sistema de votación electrónico </h4>
                <h4 class="mb-5" style="color: #fff;"> Bienvenido </h4>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label" style="font-size: 20px; color: #fff;"> Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="s_usuario" required>
                      </div>
                      <div class="mb-3">
                        <label for="descripcion" class="form-label" style="font-size: 20px; color: #fff;">Contraseña</label>
                        <input type="password" class="form-control" id="contra" name="s_contra" required>
                      </div>
                      <div class="d-grid gap-2 mb-3">
                        <button class="btn btn-primary" name = "aceptar" >Aceptar</button>
                      </div>
                </form>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php
        include ("Controladores/inicioUsuario.php")
    ?>
</body>
</html>

