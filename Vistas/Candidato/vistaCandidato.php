<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");

$consultaCandidato = mysqli_query($conexion,"SELECT id_candidato, nombre_candidato, nombre_partido, dir_foto FROM candidato");

while($datosCandidato = mysqli_fetch_array($consultaCandidato)){
    ?>
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 py-6 text-center p-5">
        <div class="espacioCandidato">
            <div>
                <?php
                    echo "<img class='img-fluid' src = '.$datosCandidato[3].' style='width: 150px; height: 150px; border-radius: 10px;'>";
                ?>
            </div>
            <div>
                <?php
                    echo "<h3> $datosCandidato[2] </h3>";
                ?>
                <div>
                <h4> Propietario </h4>
                <?php
                    echo "<h5>" .$datosCandidato[1]. "<h5>";
                ?>
            </div>
            <form method="POST" class="my-3">
                <input class="btn btn-success" type="submit" name="<?php echo $datosCandidato[0]?>,seleccionar" value = "Seleccionar">    
                <input class="btn btn-info" type="submit" name="<?php echo $datosCandidato[0] ?>,informacion" value = "Ver propuestas">
            </form>
        </div>
    </div> 
    </div>
<?php
}
?>