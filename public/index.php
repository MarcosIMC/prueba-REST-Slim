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

    $consulta = $db->query($query);

    $usuarios = $consulta->fetch_all();

    $db = null;

    //Exportar y mostrar JSON
    echo json_encode($usuarios);

    /*try{

    }catch (){

    }*/

});

$app->post('/api/usuarios/addUser', function (Request $request, Response $response){

    $dni = $request->getParam('dni');
    $nombre = $request->getParam('nombre');
    $apellidos = $request->getParam('apellidos');
    $email = $request->getParam('email');
    $dniAdmin = $request->getParam('dniAdmin');
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

$app->get('/api/admin/login/{email}', function (Request $request, Response $response){

    $email = $request->getAttribute('email');
    //$pass = $request->getAttribute('pass');

    $query = "SELECT * FROM admins WHERE email = '$email' ";

    $db = new db();

    $db = $db->conectar();

    $resultado = $db->query($query);

    $admin = $resultado->fetch_all();

    $db = null;

    echo json_encode($admin);

});

$app->run();