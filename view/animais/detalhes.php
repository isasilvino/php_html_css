<?php require_once __DIR__ . '/../template/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php if ($animal->foto): ?>
                <img src="/ProjetoIntegrador/projeto-ongs/public/uploads/<?php echo htmlspecialchars($animal->foto); ?>" 
                     class="img-fluid rounded" 
                     alt="Foto de <?php echo htmlspecialchars($animal->nome); ?>">
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h1><?php echo htmlspecialchars($animal->nome); ?></h1>
            <div class="mb-4">
                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($animal->tipo); ?></p>
                <p><strong>Raça:</strong> <?php echo htmlspecialchars($animal->raca); ?></p>
                <p><strong>Idade:</strong> <?php echo htmlspecialchars($animal->idade); ?></p>
                <p><strong>Porte:</strong> <?php echo htmlspecialchars($animal->porte); ?></p>
                <p><strong>Sexo:</strong> <?php echo $animal->sexo === 'M' ? 'Macho' : 'Fêmea'; ?></p>
            </div>

            <div class="mb-4">
                <h4>Sobre o Animal</h4>
                <p><?php echo nl2br(htmlspecialchars($animal->descricao)); ?></p>
            </div>

            <div class="mb-4">
                <h4>Sobre a ONG</h4>
                <p>
                    <strong><?php echo htmlspecialchars($animal->ong_nome); ?></strong><br>
                    <?php echo htmlspecialchars($animal->ong_cidade); ?>/<?php echo htmlspecialchars($animal->ong_estado); ?>
                </p>
            </div>

            <div class="d-grid gap-2">
                <a href="/ProjetoIntegrador/projeto-ongs/animais/adotar?id=<?php echo $animal->id; ?>" class="btn btn-primary btn-lg">
                    Quero Adotar!
                </a>
                <a href="/ProjetoIntegrador/projeto-ongs/animais" class="btn btn-outline-secondary">Voltar para Lista</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../template/footer.php'; ?> 