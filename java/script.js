document.addEventListener("DOMContentLoaded", function () {
  const popup = document.getElementById("popupForm");
  const openBtn = document.getElementById("openPopupBtn");
  const closeBtn = document.querySelector(".close-btn");

  if (openBtn && popup) {
    openBtn.addEventListener("click", () => {
      popup.style.display = "flex";
    });
  }

  if (closeBtn && popup) {
    closeBtn.addEventListener("click", () => {
      popup.style.display = "none";
    });

    window.addEventListener("click", function (event) {
      if (event.target === popup) {
        popup.style.display = "none";
      }
    });
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

document.addEventListener("DOMContentLoaded", function () {
    const linkMostrarRegistro = document.getElementById("mostrar-registro");
    const formularioRegistro = document.querySelector(".register-form-section");

    linkMostrarRegistro.addEventListener("click", function (e) {
        e.preventDefault(); // impede o comportamento padrão do link
        formularioRegistro.style.display = "block";
        formularioRegistro.scrollIntoView({ behavior: "smooth" });
    });
});