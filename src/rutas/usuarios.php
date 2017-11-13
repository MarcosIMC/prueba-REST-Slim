<?php
/**
 * Created by PhpStorm.
 * User: marke
 * Date: 07/11/2017
 * Time: 15:53
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener todos los usuarios

$app->get('/api/usuarios', function (Request $request, Response $response){

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

$app->post('/api/addUser', function (Request $request, Response $response){

});

$app->delete('/api/deleteUser', function (Request $request, Response $response){

});

$app->put('/api/updateUser', function (Request $request, Response $response){

});