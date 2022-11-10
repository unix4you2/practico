<?php 
include_once 'models/conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consulta = "SELECT vectores FROM app_Face_usuarios";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_OBJ);
$array=[];
if($data){
    foreach($data as $dat){
        array_push($array,$dat->vectores); //inserta los datos al array que esta vacio
    }
    $array = implode(", ", $array);//convierte el array en una cadena de texto, los une
    echo '['.$array.']';
}else{
    echo '[]';
}


//se almacena en formato de texto, cuando se llama si hay datos se almacena en un array