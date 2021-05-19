<?php
include_once 'con.php';
$obj = new Conexion();
$conection = $obj->Conect();

/* RECEPCION DE PARAMETROS - POR POST */

$name = (isset($_POST['name'])) ? $_POST['name'] : '';
$country = (isset($_POST['country'])) ? $_POST['country'] : '';
$age = (isset($_POST['age'])) ? $_POST['age'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch ($opcion) {
    case 1:
        /* INSERTAR NUEVO REGISTRO */
        $sql = "INSERT INTO persons (name, country, age) VALUES ('$name', '$country', '$age');";
        $result = $conection->prepare($sql);
        $result->execute();

        /* RETORNAR REGISTROS */
        $sql = "SELECT id, name, country, age FROM persons ORDER BY id DESC LIMIT 1";
        $result = $conection->prepare($sql);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        /*  ACTUALIZAR REGISTRO */
        $sql = "UPDATE persons SET name='$name',country='$country',age='$age' WHERE id='$id'";
        $result = $conection->prepare($sql);
        $result->execute();

        /* RETORNAR REGISTROS */
        $sql = "SELECT id, name, country, age FROM persons ORDER BY id DESC LIMIT 1";
        $result = $conection->prepare($sql);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $sql = "DELETE FROM persons WHERE id = '$id'";
        $result = $conection->prepare($sql);
        $result->execute();
        break;
    default:
        # code...
        break;
}

//Enviar el array final en formato json
print json_encode($data, JSON_UNESCAPED_UNICODE);

$conection = NULL;