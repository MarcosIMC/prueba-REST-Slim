<?php
/**
 * Created by PhpStorm.
 * User: marke
 * Date: 07/11/2017
 * Time: 15:45
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;

/*Route::get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

//crear rutas para los usuarios

require '../src/rutas/usuarios.php';
require '../src/rutas/admin.php';*/


//Usuarios
$app->get('/api/usuarios/getAllUsers', function (Request $request, Response $response){



    $query = "SELECT * FROM usuarios";

    $db = new db();

    //conexin
    $db = $db->conectar();

    $stmt = $db->prepare($query);
    $stmt->execute();

    $userData = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $userData['AllUsers'][] = $row;
    }

    echo json_encode($userData);
    //var_dump($userData);die();
    $db = null;

});

$app->post('/api/usuarios/addUser', function (Request $request, Response $response){

    $dni = $request->getParam('Dni');
    $nombre = $request->getParam('Nombre');
    $apellidos = $request->getParam('Apellidos');
    $email = $request->getParam('Email');
    $dniAdmin = $request->getParam('DniAdmin');
    $role = 'user';

    $consulta = "INSERT INTO usuarios (dni, nombre, apellidos, email, dniUserAdmin, role) VALUES
                  ('$dni', '$nombre', '$apellidos', '$email', '$dniAdmin', '$role')";

    $db = new db();

    $db = $db->conectar();

    $resultado = $db->query($consulta);

    $mensaje = $resultado;

    $db = null;

    echo $mensaje;


});

$app->delete('/api/usuarios/deleteUser/{id}', function (Request $request, Response $response){

});

$app->put('/api/usuarios/updateUser', function (Request $request, Response $response){

});

//Admin

$app->get('/api/admin/login', function (Request $request, Response $response){

    $email = $_REQUEST['email'];
    $pass = $_REQUEST['pass'];

    if ($email=="" || $pass==""){
        return null;
    }else{
        $query = "SELECT * FROM admins WHERE email = '$email' AND pass = '$pass' ";

        $db = new db();

        $db = $db->conectar();

        $stmt = $db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount()>0){
            $userAdmin = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $userAdmin['admin'][] = $row;
            }

            echo json_encode($userAdmin);

        }else{
            return null;
        }
        $db = null;


    }

    //var_dump($userAdmin);die();
});

$app->run();