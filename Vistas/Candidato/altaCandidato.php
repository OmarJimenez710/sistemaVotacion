<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");


if(isset($_POST['postAltaCandi'])){
    $nombre = $_POST['alta_nombreCandi'];
    $partido = $_POST['alta_partidoCandi'];
    $imagen = "./../Imagenes/Candidatos/".$_POST['alta_imagenCandi'];
    $propuesta1 = $_POST['alta_propuesta1'];
    $propuesta2 = $_POST['alta_propuesta2'];
    $propuesta3 = $_POST['alta_propuesta3'];
    $propuesta4 = $_POST['alta_propuesta4'];

    /*hacemos la insercion de la informacion dentro de la bd*/
    $sql = "INSERT INTO candidato VALUES ('','$nombre','$partido','$imagen')";
    if (mysqli_query($conexion, $sql)) {
        $consIdCandi = mysqli_query($conexion,"SELECT id_candidato FROM candidato WHERE nombre_candidato = '$nombre'");
        $id = mysqli_fetch_array($consIdCandi);

        $sql1 = "INSERT INTO propuestas VALUES ('','$id[0]','$propuesta1')";
        $resultado_qry1 = mysqli_query($conexion, $sql1);

        $sql2 = "INSERT INTO propuestas VALUES ('','$id[0]','$propuesta2')";
        $resultado_qry2 = mysqli_query($conexion, $sql2);

        $sql3 = "INSERT INTO propuestas VALUES ('','$id[0]','$propuesta3')";
        $resultado_qry3 = mysqli_query($conexion, $sql3);

        $sql4 = "INSERT INTO propuestas VALUES ('','$id[0]','$propuesta4')";
        $resultado_qry4 = mysqli_query($conexion, $sql4);

        if($resultado_qry1 && $resultado_qry2 && $resultado_qry3 && $resultado_qry4){
            ?>
                <!-- Actualizacion -->
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        background: '#73C6B6',
                        color: '#FFFFFF',
                        title: '¡REGISTRADO!',
                        text: 'Candidato registrado correctamente',
                        icon: 'success',
                    })
                </script>
            <?php
        }else{
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