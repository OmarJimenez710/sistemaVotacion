<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");


if(isset($_POST['postBusquedaCandi'])){
    /* Se optienen los datos del formulario llenado previamente */
    $nomCandidato = $_POST['busqueda_candidato'];
    

    /* Hacemos la busqueda del numero de cuenta, para tener en cuenta que verdaderamente existe  */
    $str_qry = "SELECT id_candidato FROM candidato WHERE nombre_candidato = '$nomCandidato'";
    $resultado_qry = mysqli_query($conexion,$str_qry);

    if($row = mysqli_fetch_row($resultado_qry)){    
        /*hacemos la operacion para dar de baja a un usuario de la bd*/

        $preDatosCandi = mysqli_query($conexion,"SELECT * FROM candidato WHERE id_candidato = '$row[0]'");
        $datosCandi = mysqli_fetch_array($preDatosCandi);

        $preDatospropuestas = mysqli_query($conexion,"SELECT * FROM propuestas WHERE id_candidato = '$row[0]'");

        ?>
            <!-- Actualizacion -->
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    background: '#73C6B6',
                    color: '#FFFFFF',
                    title: '¡Candidato encontrado!',
                    icon: 'success',
                    html: `
                        <div style = "text-align: center">
                            <h6> <strong> Nombre </strong> </h6>
                            <h6> <?php  echo $datosCandi[1] ?> </h6>
                            <h6> <strong> Partido </strong> </h6>
                            <h6> <?php  echo $datosCandi[2] ?> </h6>
                            <?php
                                $cont = 1;
                                while($datospropuestas = mysqli_fetch_array($preDatospropuestas)){
                                    echo "<h6> <strong> Propuesta "  .$cont.  "</strong> <h6>";
                                    echo "<p> - " .$datospropuestas[2]. "<p>";
                                    $cont++;
                                }
                            ?>
                        </div>`,
                })
            </script>
        <?php
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