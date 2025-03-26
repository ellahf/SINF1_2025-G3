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

document.addEventListener("DOMContentLoaded", function () {
    let cards = document.querySelectorAll(".collection-card");
    let popup = document.getElementById("popupConfirm");
    let confirmBtn = document.getElementById("confirmDelete");
    let cancelBtn = document.getElementById("cancelDelete");
    let cardToDelete = null;

    // Adiciona funcionalidade de edição
    cards.forEach(card => {
        let editBtn = card.querySelector(".edit-btn");
        let deleteBtn = card.querySelector(".delete-btn");
        
        editBtn.addEventListener("click", function () {
            let title = card.querySelector(".title");
            let description = card.querySelector(".description");

            let newTitle = prompt("Novo título:", title.textContent);
            let newDescription = prompt("Nova descrição:", description.textContent);

            if (newTitle !== null && newTitle.trim() !== "") title.textContent = newTitle;
            if (newDescription !== null && newDescription.trim() !== "") description.textContent = newDescription;
        });

        deleteBtn.addEventListener("click", function () {
            cardToDelete = card;
            popup.style.display = "flex";
        });
    });

    // Se confirmar, remove o card
    confirmBtn.addEventListener("click", function () {
        if (cardToDelete) {
            cardToDelete.remove();
            cardToDelete = null;
        }
        popup.style.display = "none";
    });

    // Se cancelar, apenas fecha o pop-up
    cancelBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });
});