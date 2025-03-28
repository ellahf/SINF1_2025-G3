document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popupForm");
    const openBtn = document.getElementById("openPopupBtn");
    const closeBtn = document.querySelector(".close-btn");
    const form = document.getElementById("collectionForm");
    const fileInput = document.getElementById("collectionFile");
    const previewContainer = document.getElementById("previewContainer");
    const colecoesContainer = document.querySelector(".button-collections");
  
    // Popup
    if (openBtn && popup) {
      openBtn.addEventListener("click", () => {
        popup.style.display = "flex";
      });
    }
  
    if (closeBtn && popup && form && previewContainer) {
      closeBtn.addEventListener("click", () => {
        popup.style.display = "none";
        form.reset();
        previewContainer.innerHTML = "";
      });
  
      window.addEventListener("click", function (event) {
        if (event.target === popup) {
          popup.style.display = "none";
          form.reset();
          previewContainer.innerHTML = "";
        }
      });
    }
  
    if (fileInput && previewContainer) {
      fileInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            previewContainer.innerHTML = `<img src="${e.target.result}" style="max-width:100%;">`;
          };
          reader.readAsDataURL(file);
        }
      });
    }
  
    if (form) {
      form.addEventListener("submit", function (e) {
        e.preventDefault();
        const name = document.getElementById("collectionName").value;
        const file = document.getElementById("collectionFile").files[0];
        if (!file) return alert("Escolha uma imagem.");
  
        const reader = new FileReader();
        reader.onload = function (e) {
          const nome = encodeURIComponent(name);
          const imagem = encodeURIComponent(e.target.result);
          window.location.href = `colecoes.html?nome=${nome}&imagem=${imagem}`;
        };
        reader.readAsDataURL(file);
      });
    }
  
    if (colecoesContainer) {
      const params = new URLSearchParams(window.location.search);
      const nome = params.get("nome");
      const imagem = params.get("imagem");
  
      if (nome && imagem) {
        const novaColecao = document.createElement("a");
        novaColecao.className = "collection-btn";
      
        // Criar nome de arquivo baseado no nome da coleção
        const nomeArquivo = nome
          .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
          .toLowerCase()
          .replace(/\s+/g, "")
          .replace(/[^a-z0-9]/g, "");
      
        novaColecao.href = `colecoes/${nomeArquivo}.html`;
        novaColecao.style.backgroundImage = `url('${imagem}')`;
        novaColecao.innerHTML = `<span>${nome}</span>`;
        colecoesContainer.appendChild(novaColecao);
      }      
    }
  });
  
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".delete-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
      const confirmar = confirm("Deseja apagar este item?");
      if (confirmar) {
        const card = this.closest(".collection-item");
        if (card) card.remove();
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const stars = document.querySelectorAll(".star");

  stars.forEach((star) => {
    const container = star.parentElement;

    // Efeito ao passar o mouse
    star.addEventListener("mouseover", () => {
      const value = parseInt(star.dataset.value);
      container.querySelectorAll(".star").forEach((s) => {
        s.classList.toggle("hovered", parseInt(s.dataset.value) <= value);
      });
    });

    // Tirar o efeito ao sair do mouse
    star.addEventListener("mouseout", () => {
      container.querySelectorAll(".star").forEach((s) => {
        s.classList.remove("hovered");
      });
    });

    // Marcar as estrelas selecionadas
    star.addEventListener("click", () => {
      const value = parseInt(star.dataset.value);
      container.querySelectorAll(".star").forEach((s) => {
        s.classList.toggle("selected", parseInt(s.dataset.value) <= value);
      });
    });
  });
});