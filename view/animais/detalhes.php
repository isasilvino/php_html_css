<?php require_once __DIR__ . '/../template/public-header.php'; ?>

<!-- container com margin-top maior e padding para espaçar das bordas -->
<div class="container mt-5 pt-4 pb-5">
    <div class="row gy-4 align-items-center">
        <!-- Coluna da imagem, com margem inferior para mobile -->
        <div class="col-md-6 mb-4 mb-md-0">
            <?php if ($animal->foto): ?>
                <img src="/public/uploads/<?php echo htmlspecialchars($animal->foto); ?>" 
                     class="img-fluid rounded shadow-sm" 
                     alt="Foto de <?php echo htmlspecialchars($animal->nome); ?>">
            <?php endif; ?>
        </div>

        <!-- Coluna do texto com espaçamento interno -->
        <div class="col-md-6 px-md-4">
            <h1 class="mb-4 fw-bold"><?php echo htmlspecialchars($animal->nome); ?></h1>

            <div class="mb-5">
                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($animal->tipo); ?></p>
                <p><strong>Raça:</strong> <?php echo htmlspecialchars($animal->raca); ?></p>
                <p><strong>Idade:</strong> <?php echo htmlspecialchars($animal->idade); ?></p>
                <p><strong>Porte:</strong> <?php echo htmlspecialchars($animal->porte); ?></p>
                <p><strong>Sexo:</strong> <?php echo $animal->sexo === 'M' ? 'Macho' : 'Fêmea'; ?></p>
            </div>

            <div class="mb-5">
                <h4 class="mb-3">Sobre o Animal</h4>
                <p><?php echo nl2br(htmlspecialchars($animal->descricao)); ?></p>
            </div>

            <div class="mb-5">
                <h4 class="mb-3">Sobre a ONG</h4>
                <p>
                    <strong><?php echo htmlspecialchars($animal->ong_nome); ?></strong><br>
                    <?php echo htmlspecialchars($animal->ong_cidade); ?>/<?php echo htmlspecialchars($animal->ong_estado); ?>
                </p>
            </div>

            <div class="d-grid gap-3">
                <a href="/ProjetoIntegrador/projeto-ongs/animais/adotar?id=<?php echo $animal->id; ?>" class="btn btn-primary btn-lg">
                    Quero Adotar!
                </a>
                <a href="/ProjetoIntegrador/projeto-ongs/animais" class="btn btn-outline-secondary btn-lg">Voltar para Lista</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../template/footer.php'; ?>
