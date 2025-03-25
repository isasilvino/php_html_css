<?php

$usuarios = [];

while ($opcao != 5) {



    echo "\nEscolha a opção desejada: 
 \n1) Adicionar usuario;
  \n2) Listar usuarios;
  \n3) Editar usuario;
  \n4) Remover usuario;
  \n5) Cancelar operação.\n";

    $opcao = readline();

    switch ($opcao) {
        case '1':
            echo "Digite o nome do usuario: ";
            $nome = readline();

            echo "Digite o email do usuario: ";
            $email = readline();

            $usuarios[] = ['nome' => $nome, 'email' => $email];

            break;

        case '2':
            if (count($usuarios) > 0) {
                foreach ($usuarios as $usuario) {
                    echo "Nome: {$usuario['nome']}, email: {$usuario['email']}\n";
                }
            } else {
                echo "Nenhum usuario cadastrado";
            }


            break;

        case '3':
            echo "Digite o email do usuario que deseja editar: ";
            $emailBusca = readline();
            $usuarioEncontrado = false;

            foreach ($usuarios as &$usuario) {
                if ($usuario['email'] == $emailBusca) {
                    $usuarioEncontrado = true;

                    echo "Novo nome de usuario: ";
                    $usuario['nome'] = readline();

                    echo "Novo email de usuario: ";
                    $usuario['email'] = readline();

                    echo "Usuario atualizado";
                    break;
                }
            }
            if (!$usuarioEncontrado) {
                echo "Usuario não encontrado";
            }


            break;

        case '4':
            echo "Digite o email do usuario que deseja remover: ";
            $emailBusca = readline();
            $usuarioEncontrado = false;

            foreach ($usuarios as $key =>$usuario) {
                if ($usuario['email'] == $emailBusca) {
                    $usuarioEncontrado = true;

                    
                    unset($usuarios[$key]);
                    $usuarios = array_values($usuarios);


                    echo "Usuario deletado";
                    break;
                }
            }
            if (!$usuarioEncontrado) {
                echo "Usuario não encontrado";
            }


            break;

        default:
          
            break;
    }
}
