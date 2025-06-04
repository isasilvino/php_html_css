<?php
require_once __DIR__ . '/../database/db.php'; 
require_once __DIR__ . '/../model/animal.php';
require_once __DIR__ . '/../functions.php';

class DashboardController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
        checkAuth(); // Usa a função de verificação de autenticação que criamos
    }

    public function index() {
        $ong_id = $_SESSION['ong_id'];
        $animais = Animal::findByOng($ong_id);
        include __DIR__ . '/../view/ong/dashboard.php';
    }

    public function novoAnimal() {
        include __DIR__ . '/../view/animais/novo.php';
    }

    public function salvarAnimal() {
        $nome = sanitizeInput($_POST['nome'] ?? '');
        $tipo = sanitizeInput($_POST['tipo'] ?? '');
        $raca = sanitizeInput($_POST['raca'] ?? '');
        $idade = sanitizeInput($_POST['idade'] ?? '');
        $porte = sanitizeInput($_POST['porte'] ?? '');
        $sexo = sanitizeInput($_POST['sexo'] ?? '');
        $descricao = sanitizeInput($_POST['descricao'] ?? '');
        $ong_id = $_SESSION['ong_id'];

        // Upload da imagem
        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nomeFoto = uniqid() . '.' . $extensao;
            $destino = __DIR__ . '/../public/uploads/' . $nomeFoto;

            // Garante que a pasta existe
            if (!is_dir(__DIR__ . '/../public/uploads/')) {
                mkdir(__DIR__ . '/../public/uploads/', 0777, true);
            }

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                $foto = $nomeFoto;
            }
        }

        // Insere no banco usando o model
        $result = Animal::create([
            'nome' => $nome,
            'tipo' => $tipo,
            'raca' => $raca,
            'idade' => $idade,
            'porte' => $porte,
            'sexo' => $sexo,
            'descricao' => $descricao,
            'foto' => $foto,
            'ong_id' => $ong_id
        ]);

        if ($result) {
            redirectWithSuccess('/ProjetoIntegrador/projeto-ongs/dashboard', 'Animal cadastrado com sucesso!');
        } else {
            redirectWithError('/ProjetoIntegrador/projeto-ongs/dashboard/novo', 'Erro ao cadastrar animal.');
        }
    }

    public function mostrarFormularioEdicaoAnimal() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            redirectWithError('/ProjetoIntegrador/projeto-ongs/dashboard', 'ID do animal não fornecido.');
        }

        $stmt = $this->db->query("SELECT * FROM animais WHERE id = ? AND ong_id = ?", [$id, $_SESSION['ong_id']]);
        $animal = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$animal) {
            redirectWithError('/ProjetoIntegrador/projeto-ongs/dashboard', 'Animal não encontrado.');
        }

        include __DIR__ . '/../view/ong/editar.php';
    }

    public function atualizarAnimal() {
        $id = sanitizeInput($_POST['id']);
        $nome = sanitizeInput($_POST['nome']);
        $raca = sanitizeInput($_POST['raca']);
        $idade = sanitizeInput($_POST['idade']);

        $result = $this->db->query(
            "UPDATE animais SET nome = ?, raca = ?, idade = ? WHERE id = ? AND ong_id = ?",
            [$nome, $raca, $idade, $id, $_SESSION['ong_id']]
        );

        if ($result->rowCount() > 0) {
            redirectWithSuccess('/ProjetoIntegrador/projeto-ongs/dashboard', 'Animal atualizado com sucesso!');
        } else {
            redirectWithError('/ProjetoIntegrador/projeto-ongs/dashboard', 'Erro ao atualizar animal.');
        }
    }

    public function deletarAnimal() {
        $id = sanitizeInput($_POST['id']);

        $result = $this->db->query(
            "DELETE FROM animais WHERE id = ? AND ong_id = ?",
            [$id, $_SESSION['ong_id']]
        );

        if ($result->rowCount() > 0) {
            redirectWithSuccess('/ProjetoIntegrador/projeto-ongs/dashboard', 'Animal removido com sucesso!');
        } else {
            redirectWithError('/ProjetoIntegrador/projeto-ongs/dashboard', 'Erro ao remover animal.');
        }
    }
}
