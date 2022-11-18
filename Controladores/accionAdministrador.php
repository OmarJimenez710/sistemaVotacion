<?php
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db($conexion, "sistema_votacion");

if(isset($_POST['a_alumnos'])){
    ?>
        <!--Actualizacion -->
        <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 text-center" style="margin: auto;">
                <div class="grafica scrollable">
                    <div id="piechart_3d"></div>
                </div>
            </div>
    <?php


    $alumno = mysqli_query($conexion,"SELECT * FROM alumno");

    $preVoto = mysqli_query($conexion,"SELECT count(*) FROM alumno WHERE voto_ejercidoAlumno = 1");
    $preNoVoto = mysqli_query($conexion,"SELECT count(*) FROM alumno WHERE voto_ejercidoAlumno = 0");

    /*Actualizacion*/
    $preVotoNulo = mysqli_query($conexion,"SELECT count(*) FROM votoNulo");


    $alumnoNoVoto = mysqli_query($conexion,"SELECT * FROM alumno WHERE voto_ejercidoAlumno = 0");
    $alumnoVoto = mysqli_query($conexion,"SELECT * FROM alumno WHERE voto_ejercidoAlumno = 1");

    ?>
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-5 text-center centar">
        <h2 class="mb-4"> Alumnos registrados </h2>
        <div class="scrollable mb-4">
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Alumno</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Voto Relizado </th>
                    </tr>
                </thead>
            <?php
            while($datos = mysqli_fetch_array($alumno)){
            ?> 
                <tbody>
                    <tr>
                    <?php
                        echo "<th> $datos[0] </th>";
                        echo "<th> $datos[1] $datos[2] $datos[3] </th>";
                        echo "<th> $datos[5] </th>";
                        echo "<th> $datos[6] </th>";
                        if($datos[7] == 1){
                            echo "<th><img class='img-fluid' src = '../../Imagenes/success.png' style='width: 20px;'></th>";
                        }
                        else{
                            echo "<th><img class='img-fluid' src = '../../Imagenes/danger.png' style='width: 30px;'></th>";
                        }
                    ?>
                    </tr>
            <?php
            }
            ?>
                </tbody>
            </table>
        </div>
        <form action="" method="POST">
            <button type="button" class="btn btn-success mb-5" data-bs-toggle="modal" data-bs-target="#exampleModalAlta"> Agregar </button>
            <button type="button" class="btn btn-danger mb-5" data-bs-toggle="modal" data-bs-target="#exampleModalEliminar"> Eliminar </button>
            <button type="button" class="btn btn-info mb-5" data-bs-toggle="modal" data-bs-target="#exampleModalBuscar"> Buscar </button> 
        </form> 
        <?php
            $voto = mysqli_fetch_array($preVoto);
            $noVoto = mysqli_fetch_array($preNoVoto);
            $votoNulo = mysqli_fetch_array($preVotoNulo);
        ?>

        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Votos ejercidos',  <?php echo $voto[0] ?>],
                    ['Votos no ejercidos', <?php echo $noVoto[0] ?>],
                    ['Votos nulos', <?php echo $votoNulo[0] ?>],
                ]);

                var view = new google.visualization.DataView(data);

                var options = {
                    title: 'Estadisticas de votos',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
        </script>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 text-center centrar">
        <h2 class="mb-4"> Alumnos que ya votaron </h2>
        <div class="scrollable mb-4">
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Voto Relizado </th>
                    </tr>
                </thead>
                <?php
                    while($datos = mysqli_fetch_array($alumnoVoto)){
                ?> 
                        <tbody>
                            <tr>
                            <?php
                                echo "<th> $datos[0] </th>";
                                echo "<th> $datos[1] $datos[2] $datos[3] </th>";
                                echo "<th> $datos[5] </th>";
                                echo "<th><img class='img-fluid' src = '../../Imagenes/success.png' style='width: 20px;'></th>";
                            ?>
                            </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 text-center centrar">
        <h2 class="mb-4"> Alumnos que no han votado </h2>
        <div class="scrollable mb-4">
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Voto Relizado </th>
                    </tr>
                </thead>
                <?php
                    while($datos = mysqli_fetch_array($alumnoNoVoto)){
                ?> 
                        <tbody>
                            <tr>
                            <?php
                                echo "<th> $datos[0] </th>";
                                echo "<th> $datos[1] $datos[2] $datos[3] </th>";
                                echo "<th> $datos[5] </th>";
                                echo "<th><img class='img-fluid' src = '../../Imagenes/danger.png' style='width: 30px;'></th>";
                            ?>
                            </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}



else if(isset($_POST['a_candidatos'])){
    ?>
        <!--Actualizacion -->
        <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 text-center" style="margin: auto;">
                <div class="grafica scrollable">
                    <div id="piechart_3d"></div>
                </div>
            </div>
    <?php
    
    $candidato = mysqli_query($conexion,"SELECT * FROM candidato");

    $preVoto = mysqli_query($conexion,"SELECT count(*) FROM alumno WHERE voto_ejercidoAlumno = 1");
    $preNoVoto = mysqli_query($conexion,"SELECT count(*) FROM alumno WHERE voto_ejercidoAlumno = 0");

    /*Actualizacion*/
    $preVotoNulo = mysqli_query($conexion,"SELECT count(*) FROM votoNulo");

    ?>
    <div class="col-md-12 col-lg-12 col-xl-7 mt-5 text-center col-sm-12 centrar">
        <h2> Candidatos registrados </h2>
        <div class="scrollable mb-4">
            <table class="table table-primary table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nombre del partido</th>
                    </tr>
                </thead>
            <?php
            while($datos = mysqli_fetch_array($candidato)){
            ?> 
                <tbody>
                    <tr>
                    <?php
                        echo "<th> $datos[0] </th>";
                        echo "<th> $datos[1] </th>";
                        echo "<th> $datos[2] </th>";
                    ?>
                    </tr>
            <?php
            }
            ?>
                </tbody>
            </table>
        </div>
        <form action="" method="POST">
            <button type="button" class="btn btn-success mb-5" data-bs-toggle="modal" data-bs-target="#exampleModalAltaCandi"> Agregar </button>
            <button type="button" class="btn btn-danger mb-5" data-bs-toggle="modal" data-bs-target="#exampleModalEliminarCandi"> Eliminar </button>
            <button type="button" class="btn btn-info mb-5" data-bs-toggle="modal" data-bs-target="#exampleModalBuscarCandi"> Buscar </button> 
        </form> 

        <?php
            $voto = mysqli_fetch_array($preVoto);
            $noVoto = mysqli_fetch_array($preNoVoto);
            $votoNulo = mysqli_fetch_array($preVotoNulo);
        ?>

        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Votos ejercidos',  <?php echo $voto[0] ?>],
                    ['Votos no ejercidos', <?php echo $noVoto[0] ?>],
                    ['Votos nulos', <?php echo $votoNulo[0] ?>],
                ]);

                var options = {
                    title: 'Estadisticas de votos',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
        </script>

        <div id="piechart_3d" style="margin: auto;"></div>
    </div>


<?php

    $cantidadMarcerlo = mysqli_query($conexion,"SELECT count(*) FROM votoreal WHERE id_candidato = 1");
    $cantidadGildardo = mysqli_query($conexion,"SELECT count(*) FROM votoreal WHERE id_candidato = 2");

    $votosMarcelo = mysqli_fetch_array($cantidadMarcerlo);
    $votosGildardo = mysqli_fetch_array($cantidadGildardo);

    ?>
        <!--Actualizacion -->
        <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 text-center" style="margin: auto;">
                <div class="grafica scrollable">
                    <div id="piechart_3d2"></div>
                </div>
            </div>

            <?php
                $voto = mysqli_fetch_array($preVoto);
                $noVoto = mysqli_fetch_array($preNoVoto);
                $votoNulo = mysqli_fetch_array($preVotoNulo);
            ?>

            <script type="text/javascript">
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Marcelo Romero',  <?php echo $votosMarcelo[0] ?>],
                        ['Gildardo Martínez', <?php echo $votosGildardo[0] ?>],
                    ]);

                    var options = {
                        title: 'Estadistica de votos',
                        is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
                    chart.draw(data, options);
                }
            </script>

            <div id="piechart_3d2" style="margin: auto;"></div>            
    <?php

    /* ACTUALIZACION */
    $candidato = mysqli_query($conexion,"SELECT id_candidato, nombre_candidato FROM candidato");
    
    ?>
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-5 text-center centar" style="margin: auto;">
        <h2 class="mb-4"> Estadistica de votos a favor </h2>
        <div class="scrollable mb-4">
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Candidato</th>
                    <th scope="col">Votos a favor</th>
                    </tr>
                </thead>
            <?php
            while($datosCandi = mysqli_fetch_array($candidato)){
            ?> 
                <tbody>
                    <tr>
                    <?php
                        echo "<th> $datosCandi[0] </th>";
                        echo "<th> $datosCandi[1] </th>";

                        $votoFavor = mysqli_query($conexion,"SELECT COUNT(*) FROM votoreal WHERE id_candidato = '$datosCandi[0]'");
                        $votosCandi = mysqli_fetch_array($votoFavor);

                        echo "<th> $votosCandi[0] </th>";
                    ?>
            <?php
            }
            ?>
                </tbody>
            </table>
        </div>
    <?php

}
