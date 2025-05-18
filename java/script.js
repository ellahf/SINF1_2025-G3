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

document.addEventListener("DOMContentLoaded", () => {
  const deleteButtons = document.querySelectorAll(".delete-btn");

  if (deleteButtons.length > 0) {
    deleteButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        const confirmar = confirm("Deseja apagar este item?");
        if (confirmar) {
          const card = this.closest(".collection-item");
          if (card) card.remove();
        }
      });
    });
  }
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

    if (linkMostrarRegistro && formularioRegistro) {
        linkMostrarRegistro.addEventListener("click", function (e) {
            e.preventDefault();
            formularioRegistro.style.display = "block";
            formularioRegistro.scrollIntoView({ behavior: "smooth" });
        });
    }
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

document.addEventListener("DOMContentLoaded", () => {
  const showBtn = document.getElementById("showCreateEventForm");
  const createForm = document.getElementById("createEventForm");

  if (showBtn && createEventForm) {
    showBtn.addEventListener("click", () => {
      createForm.style.display = "block";
    });

    createForm.addEventListener("submit", (event) => {
      createForm.style.display = "none";
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

document.addEventListener("DOMContentLoaded", function () {
    const closeBtn = document.getElementById('closeEditPopupBtn');
    const editForm = document.getElementById('editPopupForm');

    if (closeBtn && editForm) {
        closeBtn.addEventListener('click', () => {
            editForm.style.display = 'none';
        });
    }
});

function abrirModalEdicao(id, nome, tipo, imagem) {
  document.getElementById("edit-id").value = id;
  document.getElementById("edit-nome").value = nome;
  document.getElementById("edit-tipo").value = tipo;
  document.getElementById("edit-imagem").value = "";
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


function abrirModalEdicaoEvento(evento_id, nome, descricao, data, localizacao, imagem, colecoes_id) {
  console.log("Abrindo modal com:", evento_id, nome); // Teste no console
  document.getElementById("edit-evento-id").value = evento_id;
  document.getElementById("edit-nome").value = nome;
  document.getElementById("edit-descricao").value = descricao;
  document.getElementById("edit-data").value = data;
  document.getElementById("edit-localizacao").value = localizacao;
  document.getElementById("edit-localizacao").value = "";
  document.getElementById("edit-colecoes-id").value = colecoes_id;
  document.getElementById("modal-editar-evento").style.display = "block";
}

function fecharModalEdicaoEvento() {
  document.getElementById("modal-editar-evento").style.display = "none";
}


window.onclick = function(event) {
  const modal = document.getElementById("modal-editar-evento");
  if (event.target == modal) {
    fecharModalEdicaoEvento();
  }
}

document.getElementById("mostrarFormularioItem").addEventListener("click", function () {
    const form = document.getElementById("formularioItem");
    form.style.display = form.style.display === "none" ? "block" : "none";
});

function abrirModalEdicaoItem(item_id, nome, descricao, importancia, peso, preco, data_aquisicao, colecao_id) {
  document.getElementById("edit-item-id").value = item_id;
  document.getElementById("edit-nome").value = nome;
  document.getElementById("edit-descricao").value = descricao;
  document.getElementById("edit-importancia").value = importancia;
  document.getElementById("edit-peso").value = peso;
  document.getElementById("edit-preco").value = preco;
  document.getElementById("edit-data").value = data_aquisicao;
  document.getElementById("edit-colecao-id").value = colecao_id;

  document.getElementById("modal-editar-item").style.display = "block";
}

document.addEventListener("DOMContentLoaded", () => {
  const showBtn = document.getElementById("showDeleteFormBtn");
  const deleteForm = document.getElementById("deleteItemForm");

  if (showBtn && deleteForm) {
    showBtn.addEventListener("click", () => {
      deleteForm.style.display = "block";
    });

    deleteForm.addEventListener("submit", (event) => {
      deleteForm.style.display = "none";
    });
  }
});