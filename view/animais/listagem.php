<?php 
ob_start();
?>

<div class="container mt-5 pt-5">
    <h1 class="mb-4">Animais Disponíveis para Adoção</h1>

    <?php if (empty($animais)): ?>
        <div class="alert alert-info">
            Não há animais disponíveis para adoção no momento.
        </div>
    <?php else: ?>
        <div class="row">
        <?php foreach ($animais as $animal): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php if ($animal['foto']): ?>
                        <img src="/public/uploads/<?php echo htmlspecialchars($animal['foto']); ?>" 
                             class="card-img-top" 
                             alt="Foto de <?php echo htmlspecialchars($animal['nome']); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($animal['nome']); ?></h5>
                        <p class="card-text">
                            <strong>Tipo:</strong> <?php echo htmlspecialchars($animal['tipo']); ?><br>
                            <strong>Raça:</strong> <?php echo htmlspecialchars($animal['raca']); ?><br>
                            <strong>Idade:</strong> <?php echo htmlspecialchars($animal['idade']); ?>
                            <strong>Status:</strong> <?php echo htmlspecialchars($animal['status']); ?>
                        </p>
                        <div class="btn-group">
                            <a href="/ProjetoIntegrador/projeto-ongs/editar-animal?id=<?php echo $animal['id']; ?>" 
                               class="btn btn-primary">Editar</a>
                            <button type="button" 
                                    class="btn btn-danger" 
                                    onclick="confirmarExclusao(<?php echo $animal['id']; ?>)">
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../template/public-header.php';
echo $content;
require_once __DIR__ . '/../template/footer.php';
?> 