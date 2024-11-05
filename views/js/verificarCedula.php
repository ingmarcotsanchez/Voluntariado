
<?php
//require_once("../../config/conexion.php");
$cedula    = $_REQUEST['usu_dni'];
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "voluntariado";
$con = mysqli_connect($servidor, $usuario, $password,$basededatos) or die("No se ha podido conectar al Servidor");

//Verificando si existe algun cliente en bd ya con dicha cedula asignada
//Preparamos un arreglo que es el que contendrá toda la información
$jsonData = array();
$selectQuery   = ("SELECT usu_dni FROM usuarios WHERE usu_dni='".$cedula."' ");
$query         = mysqli_query($con, $selectQuery);
$totalCliente  = mysqli_num_rows($query);

  //Validamos que la consulta haya retornado información
  if( $totalCliente <= 0 ){
    $jsonData['success'] = 0;
    $jsonData['message'] = 'No existe Cédula ' .$cedula;
    $jsonData['message'] = '';
} else{
    //Si hay datos entonces retornas algo
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe la Cédula <strong>(' .$cedula.')<strong></p>';
  }

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>