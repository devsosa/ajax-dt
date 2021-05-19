<?php

//Se utiliza PDO

class Conexion{
    public static function Conect(){
        define('server','localhost');
        define('name_bd','crud');
        define('user','root');
        define('password','123');

        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        try {
            $conection = new PDO("mysql:host=".server."; dbname=".name_bd,user, password,$options);
            return $conection;
        } catch (Exception $e) {
            die("El error de la conexion es: ".$e->getMessage());
        }
    }
}