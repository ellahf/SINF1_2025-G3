document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popupForm");
    const openPopupBtn = document.getElementById("openPopupBtn");
    const closePopupBtn = document.querySelector(".close-btn");

    // Abrir o popup ao clicar no botão
    openPopupBtn.addEventListener("click", function () {
        popup.style.display = "flex";
    });

    // Fechar o popup ao clicar no botão "X"
    closePopupBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });

    // Fechar o popup se o usuário clicar fora do conteúdo
    window.addEventListener("click", function (event) {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });

    // Evento para adicionar a coleção
    document.getElementById("collectionForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Impede o recarregamento da página

        const name = document.getElementById("collectionName").value;
        const image = document.getElementById("collectionImage").value;

        if (name) {
            adicionarColecao(name, image);
            popup.style.display = "none"; // Fechar o popup após adicionar
        }
    });
});

// Função para adicionar uma nova coleção à lista
function adicionarColecao(nome, imagem) {
    const lista = document.getElementById("collection-list");

    // Criar novo item
    const novoItem = document.createElement("li");
    const link = document.createElement("a");
    link.href = `collection.html?name=${nome}`;
    link.textContent = nome;

    // Adicionar imagem se houver
    if (imagem) {
        const img = document.createElement("img");
        img.src = imagem;
        img.alt = nome;
        img.style.width = "50px";
        img.style.marginRight = "10px";
        novoItem.appendChild(img);
    }

    novoItem.appendChild(link);
    lista.appendChild(novoItem);
}