<?php
function db(){
    $db = new PDO('sqlite:banco:sqlite');
    var_dump($db) ;
    return $db;
     
}

db();
?>