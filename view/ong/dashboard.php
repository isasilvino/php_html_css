<?php require_once __DIR__ . '/../template/header.php'; ?>

<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <div class="col-md-12 mb-4">
        <a href="/ProjetoIntegrador/projeto-ongs/dashboard/novo" class="btn btn-primary">Cadastrar Novo Animal</a>
    </div>
</div>

<?php if (empty($animais)): ?>
    <div class="alert alert-info">
        Nenhum animal cadastrado ainda.
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

    <form id="form-excluir" method="POST" action="/ProjetoIntegrador/projeto-ongs/deletar-animal" style="display: none;">
        <input type="hidden" name="id" id="animal-id">
    </form>

    <script>
    function confirmarExclusao(id) {
        if (confirm('Tem certeza que deseja excluir este animal?')) {
            document.getElementById('animal-id').value = id;
            document.getElementById('form-excluir').submit();
        }
    }
    </script>
<?php endif; ?>

<?php require_once __DIR__ . '/../template/footer.php'; ?>
