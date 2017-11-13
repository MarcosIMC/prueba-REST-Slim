<?php
/**
 * Created by PhpStorm.
 * User: marke
 * Date: 07/11/2017
 * Time: 16:38
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/api/searchAdmin/{email}', function (Request $request, Response $response){

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