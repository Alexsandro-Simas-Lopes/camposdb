<?php 
    require_once("../../produtos/control/upload.php")
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagens</title>
</head>
<body>
    
        <button onclick="loadImgProdutos()" type="button">Enviar</button>
    
    
    <h2>Produtos Cadastrados</h2>
    <div id="produtos"></div>
    
    <script>
        document.getElementById('uploadForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const response = await fetch('upload.php', { method: 'POST', body: formData });
            const result = await response.json();
            alert(result.message || result.error);
            loadImgProdutos();
        });

        async function loadImgProdutos() {
            const response = await fetch('upload.php');
            const Img_Produtos = await response.json();
            const container = document.getElementById('produtos');
            container.innerHTML = '';
            Img_Produtos.forEach(product => {
                container.innerHTML += `<p><img src="${product.imgUrl}" width="150"></p>`;
            });
        }

        loadImgProdutos();
    </script>
</body>
</html>
