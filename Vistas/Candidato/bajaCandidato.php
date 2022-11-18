<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");


if(isset($_POST['postBajaCandi'])){
    /* Se optienen los datos del formulario llenado previamente */
    $nomCandidato = $_POST['baja_nomCandi'];
    

    /* Hacemos la busqueda del numero de cuenta, para tener en cuenta que verdaderamente existe  */
    $str_qry = "SELECT id_candidato FROM candidato WHERE nombre_candidato = '$nomCandidato'";
    $resultado_qry = mysqli_query($conexion,$str_qry);

    if($row = mysqli_fetch_row($resultado_qry)){    

        $preEliminacion = mysqli_query($conexion,"SELECT id_candidato FROM candidato WHERE nombre_candidato = '$nomCandidato'");
        $id_candidato = mysqli_fetch_array($preEliminacion);

        /*hacemos la operacion para dar de baja a un usuario de la bd*/
        $sql = "DELETE FROM candidato WHERE id_candidato = '$id_candidato[0]'";
        $sql2 = "DELETE FROM propuestas WHERE id_candidato = '$id_candidato[0]'";

        $resultado_qry = mysqli_query($conexion,$sql);
        $resultado_qry2 = mysqli_query($conexion,$sql2);

        if ($resultado_qry && $resultado_qry2) {
            ?>
                <!-- Actualizacion -->
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        background: '#73C6B6',
                        color: '#FFFFFF',
                        title: '¡Eliminado!',
                        text: 'Candidato eliminado correctamente',
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
                    text: 'Candidato no encontrado, verifique por favor',
                    icon: 'error',
                })
            </script>
        <?php
    }
}
?>
