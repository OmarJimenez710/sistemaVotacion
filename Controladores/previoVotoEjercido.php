<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");

foreach($_POST as $name => $value) {  //SACAMOS EL VALOR DEL NAME, YA QUE NO SABEMOS DE CUAL SE TRATE POR LO MISMO
                                        //QUE CREAMOS LA INTERFACE DE MANERA DINAMICA
    $cadena = explode(",",$name); //YA QUE VIENE COMO ENCAPSUALDA LA INFORMACION (ID DEL CANDIDATO QUE SE ELIGUIO Y EL 
                                    //BOTON QUE PRESIONA (SELECCIONAR O VER PROPUESTAS))
    
    if((strcmp($cadena[1], "seleccionar") === 0)){ //SE IDENTIFICA QUE BOTON SE PRESIONO 
        /*echo ("seleccionar\n\n");
        echo $cadena[0];*/

        $consultaCandidato = mysqli_query($conexion,"SELECT  dir_foto, nombre_candidato FROM candidato WHERE id_candidato = '$cadena[0]'");
        $datosCandidato = mysqli_fetch_array($consultaCandidato);

        ?>
            <div class="text-center justify-content-center fixed-top" style="margin-top: 5%;" id="ventanaEmergente">
                <!-- <div style="background-color: #DC7633s"> -->
                <div style="background-color: #fff; width: 30vw; margin: auto; border-radius: 10px;">
                <?php
                    echo "<img class='card-img-top my-3' src = '.$datosCandidato[0].' style='width: 100px;  border-radius: 10px;'>";
                ?>
                <div class="card-body">
                    <h5 class="card-title mb-3">Candidato Seleccionado</h5>
                    <?php
                        echo "<p>" .$datosCandidato[1]. "<p>";
                    ?>
                    <h5 class="card-title mb-5"> ¿Está seguro de realizar su voto? </h5>
                    <button type="button" class="btn btn-success mb-3" onclick="cargarData(<?php echo $cadena[0]; ?>)">Aceptar</button>
                    <input class="btn btn-danger mb-3" id="cancelar" type="submit" value = "Cancelar">
                </div>
                </div>
                <!-- </div> -->
            </div> 

            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">

                /* PARTE EN LA QUE MANDAMOS LA INFORMACION PARA ESTABLECER EL VOTO COMO TAL */
                function cargarData(id){
                    var url = '../../Controladores/votoEjercido.php';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'id=' + id,
                        success: function(response){
                            alert(response);
                            window.location.href = "../../index.php";
                        }
                    });
                }
                /*=========================================================================*/

                var ventanaEmrg = document.getElementById("ventanaEmergente");
                var cancelar = document.getElementById("cancelar");

                cancelar.onclick = function(){
                    ventanaEmrg.style.visibility = "hidden";
                }
            </script>
        <?php
    }

    else if((strcmp($cadena[1], "informacion") === 0)){ //SE IDENTIFICA QUE BOTON SE PRESIONO 
        /*echo ("informacion\n\n");
        echo $cadena[0];*/

        $consultaPropuesta = mysqli_query($conexion,"SELECT  propuesta FROM propuestas WHERE id_candidato = '$cadena[0]'");
        $consultaCandidato = mysqli_query($conexion,"SELECT  dir_foto, nombre_candidato FROM candidato WHERE id_candidato = '$cadena[0]'");
        $datosCandidato = mysqli_fetch_array($consultaCandidato);

        ?>
            <div class="text-center justify-content-center fixed-top" style="margin-top: 5%;" id="ventanaEmergente">
                <!--<div style="background-color: #DC7633">-->
                <div style="background-color: #fff; width: 45vw; margin: auto;  border-radius: 10px;">
                <?php
                    echo "<img class='card-img-top my-3' src = '.$datosCandidato[0].' style='width: 100px;  border-radius: 10px;'>";
                ?>
                <?php
                    echo "<p>" .$datosCandidato[1]. "<p>";
                ?>
                <div class="card-body">
                    <h5 class="card-title mb-3"> Propuestas </h5>
                    <?php
                        while($datosPropuesta = mysqli_fetch_array($consultaPropuesta)){
                            echo "<p> - " .$datosPropuesta[0]. "<p>";
                        }
                    ?>
                    <input class="btn btn-primary mb-3" id="ok" type="submit" value = "Salir" style="width: 25%;">
                </div>
                </div>
                <!-- </div> -->
            </div> 

            <script>
                var ventanaEmrg = document.getElementById("ventanaEmergente");
                var ok = document.getElementById("ok");

                ok.onclick = function(){
                    ventanaEmrg.style.visibility = "hidden";
                }
            </script>
        <?php
    }
}
