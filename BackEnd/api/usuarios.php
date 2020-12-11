<?php

//echo "Metodo HTTP: ".$_SERVER["REQUEST_METHOD"];

//echo 'Informacion'. file_get_contents('php://input'); //obtener la informacion

include_once ("../Clases/class-usuario.php");

header("Content-Type: application/json");
switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $usuario = new Usuario($_POST["nombre"], $_POST["apellido"], $_POST["identidad"], $_POST["tiempo"], $_POST["estado"]);
        $usuario->guardarUsuario();
        $resultado["mensaje"] = "Guardar usuario, informacion: ". json_encode($_POST);
        echo json_encode($resultado);
        
    break;
    case 'GET':
        if(isset($_GET['id'])){
            
            Usuario::obtenerUsuario($_GET['id']);
            echo json_encode($resultado);
        }else{
            $resultado["mensaje"] = "Retornar todos los usuarios";
            echo json_encode($resultado);
        }
    break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $resultado["mensaje"] = "Actualizar usuario con el id: ". $_GET['id']."Informacion a actualizar: ". json_encode($_PUT);
        echo json_encode($resultado);
    break;
    case 'DELETE':
        $resultado["mensaje"] = "Eliminar un usuario con el id: ". $_GET['id'];
        echo json_encode($resultado);
    break;
}

?>
