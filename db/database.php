<?php

$pdo = null;
$host = "localhost";
$user = "globaluser";
$password = "panchot9";
$db = "test-front-n5";

function connection(){
    try{
        $GLOBALS['pdo']=new PDO("mysql:host=".$GLOBALS['host'].";dbname=".$GLOBALS['db']."", $GLOBALS['user'], $GLOBALS['password']);
        $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        print "Error!: No se pudo conectar a la base de datos <br/>";
        print "\nError!: ".$e."<br/>";
        die();
    }
}

function disconnection() {
    $GLOBALS['pdo']=null;
}

function methodGet($query){
    try{
        connection();
        $statement = $GLOBALS['pdo']->prepare($query);
        $statement -> setFetchMode(PDO::FETCH_ASSOC);
        $statement -> execute();
        disconnection();
        return $statement;
    }catch(Exception $e){
        die("Erorr: ". $e);
    }
}

function methodPost($query, $queryAutoIncrement){
    try{
        connection();
        $statement = $GLOBALS['pdo']->prepare($query);
        $statement -> execute();
        $idAutoincrement = methodGet($queryAutoIncrement)->fetch(PDO::FETCH_ASSOC);
        $result = array_merge($idAutoincrement, $_POST);
        $statement -> closeCursor();
        disconnection();
        return $result;
    }catch(Exception $e){
        die("Erorr: ". $e);
    }
}

function methodPut($query){
    try{
        connection();
        $statement = $GLOBALS['pdo']->prepare($query);
        $statement -> execute();
        $result = array_merge($_GET, $_POST);
        $statement -> closeCursor();
        disconnection();
        return $result;
    }catch(Exception $e){
        die("Erorr: ". $e);
    }
}

function methodDelete($query){
    try{
        connection();
        $statement = $GLOBALS['pdo']->prepare($query);
        $statement -> execute();
        $statement -> closeCursor();
        disconnection();
        return $_GET['id'];
    }catch(Exception $e){
        die("Erorr: ". $e);
    }
}
?>