<?php 

$host='localhost';
$user='root';
$name='chat';
$pass='';

try{
    $db=new PDO("mysql:dbhost=$host;dbname=$name",$user,$pass);
}catch(PDOException $e){
    echo $e->getMessage();
}

?>