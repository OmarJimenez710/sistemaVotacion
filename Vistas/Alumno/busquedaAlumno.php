<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");


if(isset($_POST['postBusqueda'])){
    /* Se optienen los datos del formulario llenado previamente */
    $numCuenta = $_POST['busqueda_alumno'];
    

    /* Hacemos la busqueda del numero de cuenta, para tener en cuenta que verdaderamente existe  */
    $str_qry = "SELECT id_alumno FROM alumno WHERE num_cuentaAlumno = '$numCuenta'";
    $resultado_qry = mysqli_query($conexion,$str_qry);

    if($row = mysqli_fetch_row($resultado_qry)){    
        /*hacemos la operacion para dar de baja a un usuario de la bd*/
        $sql = "SELECT nombre_alumno, apellido_paternoAlumno, apellido_maternoAlumno, correo_electronicoAlumno,
                num_cuentaAlumno, contraseniaAlumno FROM alumno WHERE num_cuentaAlumno = '$numCuenta'";
        
        $resultado_qry = mysqli_query($conexion,$sql);

        if ($row = mysqli_fetch_row($resultado_qry)) {
            ?>
                <!-- Actualizacion -->
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        background: '#73C6B6',
                        color: '#FFFFFF',
                        title: '¡Encontrado!',
                        icon: 'success',
                        html: `
                                <div style = "text-align: center">
                                    <h6> <strong> Nombre </strong> </h6>
                                    <h6> <?php  echo $row[0], ' ', $row[1], ' ', $row[2]; ?> </h6>
                                    <h6> <strong> Correo </strong> </h6>
                                    <h6> <?php  echo $row[3] ?> </h6>
                                    <h6> <strong> Usuario </strong> </h6>
                                    <h6> <?php  echo $row[4] ?></h6>
                                    <h6> <strong> Contraseña </strong> </h6>
                                    <h6> <?php  echo $row[5] ?></h6>
                                </div>`,
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
                    title: '¡Sin resultados!',
                    text: 'El número de cuenta ingresado, no corresponde a ningún registro',
                    icon: 'error',
                })
            </script>
        <?php
    }
}
?>