<?php

//conexao com banco de dados onde a funcao db armazena a variavel db que contem um pdo 
//(php data objetcs - padroniza o jeito de conexao ao banco de dados ja utiliza pstm) que ja tem o caminho do banco de dados
//no fim retorna o db pra assim que chamar a função ja estabelecer a conexao.

function db(){
    $db = new PDO('sqlite:banco.sqlite');
   
    return $db;
     
}


?>