fetch("http://localhost/camposdb/public/api/getProdutos.php") // Use o caminho absoluto
  .then(response => response.json())
  .then(data => {
    MENU = data;
    
  })
  .catch(error => console.error("Erro ao carregar produtos:", error));

var MENU = []; // Variável global

async function carregarProdutos() {
    try {
        const response = await fetch("http://localhost/camposdb/public/api/getProdutos.php");
        MENU = await response.json();
        console.log("Produtos carregados:", MENU);
    } catch (error) {
        console.error("Erro ao carregar produtos:", error);
    }
}

// Chamar a função ao carregar o site
carregarProdutos();

// Função para garantir que MENU esteja carregado antes de ser usado
function getMENU(callback) {
    if (MENU.length > 0) {
        callback(MENU);
    } else {
        setTimeout(() => getMENU(callback), 500); // Tenta novamente a cada 500ms
    }
}