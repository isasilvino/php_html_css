<?php require_once __DIR__ . '/../template/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Formulário de Adoção</h2>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h4>Animal: <?php echo htmlspecialchars($animal->nome); ?></h4>
                        <p>
                            <?php echo htmlspecialchars($animal->tipo); ?> - 
                            <?php echo htmlspecialchars($animal->raca); ?> - 
                            <?php echo htmlspecialchars($animal->idade); ?>
                        </p>
                        <p>ONG: <?php echo htmlspecialchars($animal->ong_nome); ?></p>
                    </div>

                    <form action="/ProjetoIntegrador/projeto-ongs/animais/enviar-candidatura" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="animal_id" value="<?php echo $animal->id; ?>">

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo *</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                            <div class="invalid-feedback">Por favor, informe seu nome completo.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Por favor, informe um e-mail válido.</div>
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone *</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" required>
                            <div class="invalid-feedback">Por favor, informe seu telefone.</div>
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço Completo *</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" required>
                            <div class="invalid-feedback">Por favor, informe seu endereço.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="cidade" class="form-label">Cidade *</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" required>
                                <div class="invalid-feedback">Por favor, informe sua cidade.</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Selecione...</option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                                <div class="invalid-feedback">Por favor, selecione seu estado.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="motivo" class="form-label">Por que você quer adotar este animal? *</label>
                            <textarea class="form-control" id="motivo" name="motivo" rows="4" required></textarea>
                            <div class="invalid-feedback">Por favor, conte-nos por que você quer adotar este animal.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Enviar Solicitação de Adoção</button>
                            <a href="/ProjetoIntegrador/projeto-ongs/animais/detalhes?id=<?php echo $animal->id; ?>" class="btn btn-outline-secondary">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validação do formulário
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>

<?php require_once __DIR__ . '/../template/footer.php'; ?> 