
<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");


if(isset($_POST['aceptar'])){
    $nom_usuario = $_POST['s_usuario'];
    $contra_usuario = $_POST['s_contra'];

    $consultaAlumno = mysqli_query($conexion,"SELECT id_alumno, num_cuentaAlumno, contraseniaAlumno, voto_ejercidoAlumno FROM alumno WHERE  num_cuentaAlumno = '$nom_usuario' AND contraseniaAlumno = '$contra_usuario'");
    $consultaAdministrador = mysqli_query($conexion,"SELECT id_administrador, usuario_administrador, contrasenia_administrador FROM administrador WHERE  usuario_administrador = '$nom_usuario' AND contrasenia_administrador = '$contra_usuario'");
       
    if($consultaAlumno->num_rows>0){ /* quiere decir que si existe registro para un usuario y contraseña alumno*/
        $datosAlumno = mysqli_fetch_array($consultaAlumno);
        $votoAlumno = mysqli_query($conexion,"SELECT id_votoReal FROM votoreal WHERE  id_alumno = '$datosAlumno[0]'");

        if($votoAlumno->num_rows>0){
            ?>
                <script>
                    alert("Usted ya ha finalizado su proceso de votación");
                </script>
            <?php
        }else{
            session_start();
            $_SESSION['alumno'] = $datosAlumno[0];
            header("Location: Vistas/Alumno/eleccion.php");
        }
    }
    else if($consultaAdministrador->num_rows>0){ /* quiere decir que si existe registro para un usuario y contraseña admin*/
        $datosAdministrador = mysqli_fetch_array($consultaAdministrador);

        session_start();
        $_SESSION['administrador'] = $datosAdministrador[0];
        header("Location: Vistas/Administrador/administracion.php");
    }
    else{
        ?>
            <script>
                alert("Error, usuario no válido");
            </script>
        <?php
    }
}

