<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");


if(isset($_POST['postAlta'])){
    /* Se optienen los datos del formulario llenado previamente */
    $nombre = $_POST['alta_nombre'];
    $apellidoPaterno = $_POST['alta_apellidoP'];
    $apellidoMaterno = $_POST['alta_apellidoM'];
    $correo = $_POST['alta_correo'];
    $numCuenta = $_POST['alta_numCuenta'];
    $contra = $_POST['alta_contra'];

    /*hacemos la insercion de la informacion dentro de la bd*/
    $sql = "INSERT INTO alumno VALUES ('','$nombre','$apellidoPaterno','$apellidoMaterno','$correo','$numCuenta','$contra','0')";
    if (mysqli_query($conexion, $sql)) {
        ?>
            <!-- Actualizacion -->
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    background: '#73C6B6',
                    color: '#FFFFFF',
                    title: '¡REGISTRADO!',
                    text: 'Alumno registrado correctamente',
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
}
?>