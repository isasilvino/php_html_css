<?php
require_once __DIR__ . '/../model/animal.php';
require_once __DIR__ . '/../functions.php';

class AnimalController {
    public function listagemPublica() {
        $animais = Animal::findAllDisponiveis();
        require __DIR__ . '/../view/animais/listagem.php';
    }

    public function detalhes() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            redirectWithError('/animais', 'Animal não encontrado.');
        }

        $animal = Animal::findById($id);
        if (!$animal || $animal->status !== 'disponivel') {
            redirectWithError('/animais', 'Animal não encontrado ou não disponível para adoção.');
        }

        require __DIR__ . '/../view/animais/detalhes.php';
    }

    public function formularioAdocao() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            redirectWithError('/animais', 'Animal não encontrado.');
        }

        $animal = Animal::findById($id);
        if (!$animal || $animal->status !== 'disponivel') {
            redirectWithError('/animais', 'Animal não encontrado ou não disponível para adoção.');
        }

        require __DIR__ . '/../view/animais/formulario-adocao.php';
    }

    public function enviarCandidatura() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectWithError('/animais', 'Método não permitido.');
        }

        $animal_id = filter_input(INPUT_POST, 'animal_id', FILTER_VALIDATE_INT);
        if (!$animal_id) {
            redirectWithError('/animais', 'Animal não encontrado.');
        }

        $animal = Animal::findById($animal_id);
        if (!$animal || $animal->status !== 'disponivel') {
            redirectWithError('/animais', 'Animal não encontrado ou não disponível para adoção.');
        }

        // Validação dos campos do formulário
        $campos = [
            'nome' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_EMAIL,
            'telefone' => FILTER_SANITIZE_STRING,
            'endereco' => FILTER_SANITIZE_STRING,
            'cidade' => FILTER_SANITIZE_STRING,
            'estado' => FILTER_SANITIZE_STRING,
            'motivo' => FILTER_SANITIZE_STRING
       ];

        $dados = filter_input_array(INPUT_POST, $campos);

        // Verifica se todos os campos foram preenchidos
        if (in_array(false, $dados, true) || in_array(null, $dados, true)) {
            redirectWithError("/animais/adotar?id={$animal_id}", 'Todos os campos são obrigatórios.');
        }

        // Salva o formulário
        try {
            $db = Database::getInstance();
            $sql = "INSERT INTO formularios 
                    (nome_solicitante, email, telefone, endereco, cidade, estado, animal_id, observacoes) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $db->query($sql, [
                $dados['nome'],
                $dados['email'],
                $dados['telefone'],
                $dados['endereco'],
                $dados['cidade'],
                $dados['estado'],
                $animal_id,
                $dados['motivo'] // Usando o campo motivo como observações
            ]);

            redirectWithSuccess('/animais', 'Sua solicitação de adoção foi enviada com sucesso! Em breve a ONG entrará em contato.');
        } catch (Exception $e) {
            error_log("Erro ao salvar formulário de adoção: " . $e->getMessage());
            redirectWithError("/animais/adotar?id={$animal_id}", 'Erro ao enviar solicitação. Tente novamente.');
        }
    }
}
