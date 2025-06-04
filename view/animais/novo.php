<!-- view/dashboard/novoAnimal.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Animal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Cadastrar Novo Animal</h1>

        <form action="/dashboard/salvar" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block font-medium">Nome</label>
                <input type="text" name="nome" required class="w-full border border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Tipo</label>
                <select name="tipo" required class="w-full border border-gray-300 rounded p-2">
                    <option value="cao">Cão</option>
                    <option value="gato">Gato</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">Raça</label>
                <input type="text" name="raca" class="w-full border border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Idade</label>
                <input type="text" name="idade" class="w-full border border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Porte</label>
                <input type="text" name="porte" class="w-full border border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Sexo</label>
                <select name="sexo" required class="w-full border border-gray-300 rounded p-2">
                    <option value="M">Macho</option>
                    <option value="F">Fêmea</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">Descrição</label>
                <textarea name="descricao" rows="4" class="w-full border border-gray-300 rounded p-2"></textarea>
            </div>
            <div class="mb-4">
                    <label for="estado" class="block text-gray-700 mb-2">Situação do animal</label>
                    <select  name="status" required class="w-full border rounded p-2">
                        <option value="">Selecione...</option>
                        <option value="disponivel">Disponivel</option>
                        <option value="adotado">Adotado</option>
                        <option value="em_processo">Em processo</option>
                        </div>

            <div>
                <label class="block font-medium">Foto</label>
                <input type="file" name="foto" accept="image/*" class="w-full">
            </div>

            <div class="d-flex justify-content-between">
                <a href="/dashboard" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Cadastrar Animal</button>
            </div>
        </form>
    </div>

    <script>
    // Preview da imagem
    document.getElementById('foto').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.createElement('img');
                preview.src = e.target.result;
                preview.style.maxWidth = '200px';
                preview.style.marginTop = '10px';
                preview.className = 'img-thumbnail';
                
                var previewContainer = document.getElementById('foto').parentNode;
                var oldPreview = previewContainer.querySelector('img');
                if (oldPreview) {
                    previewContainer.removeChild(oldPreview);
                }
                previewContainer.appendChild(preview);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Confirmação antes de cancelar se houver dados preenchidos
    document.querySelector('a.btn-secondary').addEventListener('click', function(e) {
        var form = document.querySelector('form');
        var formData = new FormData(form);
        var hasData = false;

        for (var pair of formData.entries()) {
            if (pair[0] !== 'foto' && pair[1]) {
                hasData = true;
                break;
            }
        }

        if (hasData) {
            if (!confirm('Tem certeza que deseja cancelar? Todos os dados preenchidos serão perdidos.')) {
                e.preventDefault();
            }
        }
    });
    </script>
</body>
</html>
