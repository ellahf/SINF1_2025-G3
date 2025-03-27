// Função para abrir o pop-up
document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popupForm"); // Pega o formulário
    const openPopupBtn = document.getElementById("openPopupBtn"); // Botão de abrir
    const closePopupBtn = document.querySelector(".close-btn"); // Botão "X" de fechar

    // Quando o botão "Criar Nova Coleção" for clicado, mostrar o popup
    openPopupBtn.addEventListener("click", function () {
        popup.style.display = "flex";
    });

    // Quando clicar no botão "X", esconder o popup
    closePopupBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });

    // Fechar o popup ao clicar fora dele (fundo escuro)
    window.addEventListener("click", function (event) {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });
});

function mostrarDetalhes(id) {
    document.querySelectorAll('.detalhe-item').forEach(div => div.style.display = 'none');
    document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    document.getElementById(id).style.display = 'block';
}

function voltar() {
    document.querySelectorAll('.detalhe-item').forEach(div => div.style.display = 'none');
    window.scrollTo({ top: 500, behavior: 'smooth' });
}

document.querySelectorAll(".edit-btn").forEach(button => {
    button.addEventListener("click", function () {
        let card = this.parentElement;
        let title = card.querySelector(".title");
        let description = card.querySelector(".description");

        let newTitle = prompt("Novo título:", title.textContent);
        let newDescription = prompt("Nova descrição:", description.textContent);

        if (newTitle) title.textContent = newTitle;
        if (newDescription) description.textContent = newDescription;
    });
});

let editandoId = null;

function editItem(id) {
  editandoId = id;

  const titulo = document.getElementById(`title${id}`).textContent;
  const descricao = document.getElementById(`desc${id}`).textContent;
  const imagem = document.getElementById(`img${id}`).src;

  document.getElementById("editTitulo").value = titulo;
  document.getElementById("editDescricao").value = descricao;
  document.getElementById("editImagem").value = imagem;

  document.getElementById("editPopup").style.display = "flex";
}

function fecharPopupEdit() {
  document.getElementById("editPopup").style.display = "none";
  editandoId = null;
}

function salvarEdicao() {
  const novoTitulo = document.getElementById("editTitulo").value;
  const novaDescricao = document.getElementById("editDescricao").value;
  const novaImagem = document.getElementById("editImagem").value;

  document.getElementById(`title${editandoId}`).textContent = novoTitulo;
  document.getElementById(`desc${editandoId}`).textContent = novaDescricao;
  document.getElementById(`img${editandoId}`).src = novaImagem;

  fecharPopupEdit();
}