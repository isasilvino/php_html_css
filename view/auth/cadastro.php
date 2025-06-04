<?php
// Começamos a captura do buffer para guardar o conteúdo da view
ob_start();
?>

<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Cadastro de ONG</h2>
    
    <div class="max-w-2xl mx-auto">
        <form action="/ProjetoIntegrador/projeto-ongs/auth/cadastro" method="POST" class="space-y-4">
            <div class="mb-4">
                <label for="nome" class="block text-gray-700 mb-2">Nome da ONG</label>
                <input type="text" id="nome" name="nome" required 
                       class="w-full border rounded p-2" placeholder="Nome da sua ONG" />
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" required 
                       class="w-full border rounded p-2" placeholder="email@exemplo.com" />
            </div>

            <div class="mb-4">
                <label for="senha" class="block text-gray-700 mb-2">Senha</label>
                <input type="password" id="senha" name="senha" required 
                       class="w-full border rounded p-2" placeholder="Sua senha" />
            </div>

            <div class="mb-4">
                <label for="telefone" class="block text-gray-700 mb-2">Telefone</label>
                <input type="tel" id="telefone" name="telefone" required 
                       class="w-full border rounded p-2" placeholder="(00) 00000-0000" />
            </div>

            <div class="mb-4">
                <label for="endereco" class="block text-gray-700 mb-2">Endereço</label>
                <input type="text" id="endereco" name="endereco" required 
                       class="w-full border rounded p-2" placeholder="Rua, número, bairro" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="cidade" class="block text-gray-700 mb-2">Cidade</label>
                    <input type="text" id="cidade" name="cidade" required 
                           class="w-full border rounded p-2" placeholder="Sua cidade" />
                </div>

                <div class="mb-4">
                    <label for="estado" class="block text-gray-700 mb-2">Estado</label>
                    <select id="estado" name="estado" required class="w-full border rounded p-2">
                        <option value="">Selecione...</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label for="descricao" class="block text-gray-700 mb-2">Descrição</label>
                <textarea id="descricao" name="descricao" required 
                         class="w-full border rounded p-2" rows="4" 
                         placeholder="Conte um pouco sobre o trabalho da sua ONG"></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    Cadastrar
                </button>
            </div>
        </form>

        <p class="mt-6 text-center">
            Já possui conta? <a class="text-blue-600 hover:underline" href="/ProjetoIntegrador/projeto-ongs/login">Fazer Login</a>
        </p>
    </div>
</div>

<?php
// Guarda o conteúdo gerado no buffer em $content
$content = ob_get_clean();
// Inclui o template principal que vai exibir o conteúdo dentro do layout
include_once __DIR__ . '/../template/app.php';
?>
