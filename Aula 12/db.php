<?php
function db(){
    $db = new PDO('sqlite:banco.sqlite');
   
    return $db;
     
}


?>