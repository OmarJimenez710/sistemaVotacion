<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");


if(isset($_POST['postBaja'])){
    /* Se optienen los datos del formulario llenado previamente */
    $numCuenta = $_POST['baja_numCuenta'];
    

    /* Hacemos la busqueda del numero de cuenta, para tener en cuenta que verdaderamente existe  */
    $str_qry = "SELECT id_alumno FROM alumno WHERE num_cuentaAlumno = '$numCuenta'";
    $resultado_qry = mysqli_query($conexion,$str_qry);

    if($row = mysqli_fetch_row($resultado_qry)){    
        /*hacemos la operacion para dar de baja a un usuario de la bd*/
        $sql = "DELETE FROM alumno WHERE num_cuentaAlumno = '$numCuenta'";

        if (mysqli_query($conexion, $sql)) {
            ?>
                <!-- Actualizacion -->
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        background: '#73C6B6',
                        color: '#FFFFFF',
                        title: '¡Eliminado!',
                        text: 'Alumno eliminado correctamente',
                        icon: 'success',
                    })
                </script>
            <?php
        } else {
            ?>
                <!-- Actualizacion -->
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        background: '#F1948A',
                        color: '#FFFFFF',
                        title: '¡ERROR!',
                        text: 'Se ha producido un error, intente mas tarde',
                        icon: 'error',
                    })
                </script>
            <?php
        }
    } else{
        ?>
            <!-- Actualizacion -->
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    background: '#F1948A',
                        color: '#FFFFFF',
                    title: '¡ERROR!',
                    text: 'El número de cuenta que ingreso, no existe',
                    icon: 'error',
                })
            </script>
        <?php
    }
}
?>




