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
                    <div class="card h-100 shadow-sm">
                        <?php if ($animal['foto']): ?>
                            <img src="/ProjetoIntegrador/projeto-ongs/public/uploads/<?php echo htmlspecialchars($animal['foto']); ?>" 
                                 class="card-img-top" 
                                 alt="Foto de <?php echo htmlspecialchars($animal['nome']); ?>"
                                 style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <img src="https://placehold.co/400x400/e9ecef/808080?text=Pet" 
                                 class="card-img-top" 
                                 alt="Imagem padrão de pet"
                                 style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($animal['nome']); ?></h5>
                            <p class="card-text">
                                <strong>Tipo:</strong> <?php echo htmlspecialchars($animal['tipo']); ?><br>
                                <strong>Raça:</strong> <?php echo htmlspecialchars($animal['raca']); ?><br>
                                <strong>Idade:</strong> <?php echo htmlspecialchars($animal['idade']); ?><br>
                                <strong>Porte:</strong> <?php echo htmlspecialchars($animal['porte']); ?>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    ONG <?php echo htmlspecialchars($animal['ong_nome']); ?><br>
                                    <?php echo htmlspecialchars($animal['ong_cidade']); ?>/<?php echo htmlspecialchars($animal['ong_estado']); ?>
                                </small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-grid gap-2">
                                <a href="/ProjetoIntegrador/projeto-ongs/animais/detalhes?id=<?php echo $animal['id']; ?>" 
                                   class="btn btn-primary">Ver Detalhes</a>
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