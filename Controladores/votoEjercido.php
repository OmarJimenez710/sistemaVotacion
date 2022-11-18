<?php

session_start();

$conexion = mysqli_connect("localhost","root","","sistema_votacion");

$id_candidato = $_POST["id"];
$id_alumno = $_SESSION['alumno'];

$str_qry = "INSERT INTO votoreal VALUES ('','$id_alumno','$id_candidato')";
$resultado_qry = mysqli_query($conexion,$str_qry);

$str2_qry = "UPDATE alumno SET voto_ejercidoAlumno = '1' WHERE id_alumno='$id_alumno'";
$ejecuta_qry = mysqli_query($conexion,$str2_qry);

if ($resultado_qry && $ejecuta_qry){
    echo ("Su voto ha quedado establecido");
} else {
    $str_qry = "DELETE * FROM votoreal WHERE  id_alumno = '$id_alumno' and id_candidato = '$id_candidato'";
    $resultado_qry = mysqli_query($conexion,$str_qry);

    $str2_qry = "UPDATE alumno SET voto_ejercidoAlumno = '0' WHERE id_alumno='$id_alumno'";
    $ejecuta_qry = mysqli_query($conexion,$str2_qry);

    echo("Ha ocurrido un error, intente mas tarde");
}

session_destroy();
?>