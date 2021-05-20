<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="select * from tbl_usuario where id_usuario=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from tbl_usuario";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nombre=$_POST['nombre'];
    $cedula=$_POST['cedula'];
    $telefono=$_POST['telefono'];
    $mail=$_POST['mail'];
    $query="insert into tbl_usuario(nombre_usuario, cedula_usuario, telefono_usuario, mail_usuario) values ('$nombre', '$cedula', '$telefono', '$mail')";
    $queryAutoIncrement="select MAX(id_usuario) as id from tbl_usuario";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $nombre=$_POST['nombre'];
    $cedula=$_POST['cedula'];
    $telefono=$_POST['telefono'];
    $mail=$_POST['mail'];
    $query="UPDATE tbl_usuario SET nombre_usuario='$nombre', cedula_usuario='$cedula', telefono_usuario='$telefono', mail_usuario='$mail' WHERE id_usuario='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM tbl_usuario WHERE id_usuario='$id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>