document.addEventListener("DOMContentLoaded", () => {
  console.log("Script carregado!");
  const popup = document.getElementById("popupForm");
  const openBtn = document.getElementById("openPopupBtn");
  const closeX = document.querySelector(".close-btn");
  const cancelBtn = document.getElementById("closePopupBtn");

  if (openBtn && popup) {
    openBtn.addEventListener("click", () => {
      console.log("Botão clicado!");
      popup.style.display = "flex";
    });
  }

  if (closeX && popup) {
    closeX.addEventListener("click", () => {
      popup.style.display = "none";
    });
  }

  if (cancelBtn && popup) {
    cancelBtn.addEventListener("click", () => {
      popup.style.display = "none";
    });
  }

  window.addEventListener("click", (event) => {
    if (event.target === popup) {
      popup.style.display = "none";
    }
  });
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

document.addEventListener("DOMContentLoaded", function () {
    const linkMostrarRegistro = document.getElementById("mostrar-registro");
    const formularioRegistro = document.querySelector(".register-form-section");

    linkMostrarRegistro.addEventListener("click", function (e) {
        e.preventDefault(); // impede o comportamento padrão do link
        formularioRegistro.style.display = "block";
        formularioRegistro.scrollIntoView({ behavior: "smooth" });
    });
});

document.addEventListener("DOMContentLoaded", () => {
  const showBtn = document.getElementById("showDeleteFormBtn");
  const deleteForm = document.getElementById("deleteEventForm");

  if (showBtn && deleteForm) {
    showBtn.addEventListener("click", () => {
      deleteForm.style.display = "block";
    });

    deleteForm.addEventListener("submit", (event) => {
      deleteForm.style.display = "none";
    });
  }
});

document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('edit_id').value = button.dataset.id;
        document.getElementById('edit_nome').value = button.dataset.nome;
        document.getElementById('edit_tipo').value = button.dataset.tipo;

        document.getElementById('editPopupForm').style.display = 'block';
    });
});

document.getElementById('closeEditPopupBtn').addEventListener('click', () => {
    document.getElementById('editPopupForm').style.display = 'none';
});

function abrirModalEdicao(id, nome, tipo, imagem) {
  console.log("Modal aberto");
  document.getElementById("edit-id").value = id;
  document.getElementById("edit-nome").value = nome;
  document.getElementById("edit-tipo").value = tipo;
  document.getElementById("edit-imagem").value = imagem;
  document.getElementById("modal-editar-colecao").style.display = "block";
}

function fecharModalEdicao() {
  document.getElementById("modal-editar-colecao").style.display = "none";
}

window.onclick = function(event) {
  const modal = document.getElementById("modal-editar-colecao");
  if (event.target == modal) {
    fecharModalEdicao();
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const openCreateEventBtn = document.getElementById("openCreateEventBtn");
  const modal = document.getElementById("modal-editar-colecao");
  const closeCreateEventBtn = document.getElementById("closeCreateEventBtn");
  const createEventForm = document.getElementById("createEventForm");

  openCreateEventBtn.addEventListener("click", () => {
    abrirModalCriarEvento();
  });

  closeCreateEventBtn.addEventListener("click", () => {
    fecharModalCriarEvento();
  });

  // Fecha modal se clicares fora do conteúdo
  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      fecharModalCriarEvento();
    }
  });

  function abrirModalCriarEvento() {
    // Limpar campos
    document.getElementById("create-evento-id").value = '';
    document.getElementById("create-nome").value = '';
    document.getElementById("create-descricao").value = '';
    document.getElementById("create-localizacao").value = '';
    document.getElementById("create-data").value = '';
    document.getElementById("create-imagem").value = '';
    document.getElementById("create-colecoes_id").value = '';

    modal.style.display = "flex";
  }

  function fecharModalCriarEvento() {
    modal.style.display = "none";
  }

  // Podes colocar o submit do form aqui (com AJAX ou submit normal)
  createEventForm.addEventListener("submit", (e) => {
    e.preventDefault();
    // Exemplo simples: fechar modal após submit
    alert("Evento guardado (aqui implementa a tua lógica!)");
    fecharModalCriarEvento();
  });
});