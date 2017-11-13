<?php
/**
 * Created by PhpStorm.
 * User: marke
 * Date: 07/11/2017
 * Time: 15:55
 */

    class db {
        private $host = 'localhost';
        private $user = 'root';
        private $pass = '';
        private $db = 'appxamarin';


        //Conexion a la BBDD

        public function conectar(){
            $conexion = new mysqli($this->host, $this->user, $this->pass, $this->db);

            return $conexion;
        }
    }