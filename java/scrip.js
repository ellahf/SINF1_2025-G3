// Função para abrir o pop-up
function abrirPopup() {
    document.getElementById("popupForm").style.display = "flex";
}

// Função para fechar o pop-up
function fecharPopup() {
    document.getElementById("popupForm").style.display = "none";
}

// Evento para abrir o pop-up ao clicar no botão
document.getElementById("openPopupBtn").addEventListener("click", abrirPopup);

// Evento para fechar o pop-up ao clicar no botão "X"
document.querySelector(".close-btn").addEventListener("click", fecharPopup);

// Fechar o pop-up se o usuário clicar fora dele
window.addEventListener("click", function (event) {
    if (event.target.id === "popupForm") {
        fecharPopup();
    }
});

// Evento para adicionar coleção ao clicar no botão "Adicionar"
document.getElementById("collectionForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Impede o recarregamento da página

    const nome = document.getElementById("collectionName").value;
    const imagem = document.getElementById("collectionImage").value;

    if (nome) {
        adicionarColecao(nome, imagem);
        fecharPopup(); // Fecha o pop-up após adicionar
    }
});

// Função para adicionar nova coleção à lista
function adicionarColecao(nome, imagem) {
    const lista = document.getElementById("collection-list");
    const item = document.createElement("li");
    const link = document.createElement("a");

    link.href = `collection.html?name=${nome}`;
    link.textContent = nome;

    if (imagem) {
        const img = document.createElement("img");
        img.src = imagem;
        img.alt = nome;
        img.style.width = "50px";
        img.style.marginRight = "10px";
        item.appendChild(img);
    }

    item.appendChild(link);
    lista.appendChild(item);
}

// Configuração do slider
document.addEventListener("DOMContentLoaded", function () {
    const sliderContainer = document.querySelector(".slider-container");
    const slider = document.querySelector(".slider");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let posicao = 0; // Posição inicial
    const larguraItem = slider.querySelector(".item").offsetWidth + 20; // Pega a largura de um item + margem

    // Verifica a largura total do slider
    function atualizarBotoes() {
        nextBtn.style.display = (posicao >= slider.scrollWidth - sliderContainer.clientWidth) ? "none" : "block";
        prevBtn.style.display = (posicao <= 0) ? "none" : "block";
    }

    // Função para mover o slider para frente
    function moverParaFrente() {
        if (posicao < slider.scrollWidth - sliderContainer.clientWidth) {
            posicao += larguraItem * 4; // Move 4 itens
            slider.style.transform = `translateX(-${posicao}px)`;
            atualizarBotoes();
        }
    }

    // Função para mover o slider para trás
    function moverParaTras() {
        if (posicao > 0) {
            posicao -= larguraItem * 4; // Move 4 itens para trás
            slider.style.transform = `translateX(-${posicao}px)`;
            atualizarBotoes();
        }
    }

    // Adiciona eventos aos botões
    nextBtn.addEventListener("click", moverParaFrente);
    prevBtn.addEventListener("click", moverParaTras);

    // Atualiza os botões ao carregar a página
    atualizarBotoes();
});