document.addEventListener("DOMContentLoaded", function() {
  const reglas = {
    nombre: {
      selector: 'input[name="nombre"]',
      mensaje: "El nombre solo puede tener letras, espacios, guiones o apostrofes.",
      validar: function(valor) {
        return validarTexto(valor, /^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ]+(?:[ '-][A-Za-zÁÉÍÓÚÜÑáéíóúüñ]+)*$/, 2, 50);
      }
    },
    titulo: {
      selector: 'input[name="titulo"]',
      mensaje: "El titulo debe tener letras o numeros y no usar caracteres raros.",
      validar: function(valor) {
        return validarTextoRuta(valor, 3, 100);
      }
    },
    punto_inicio: {
      selector: 'input[name="punto_inicio"]',
      mensaje: "El punto de inicio debe tener letras o numeros y no usar caracteres raros.",
      validar: function(valor) {
        return validarTextoRuta(valor, 3, 120);
      }
    },
    cimas: {
      selector: 'input[name="cimas"]',
      mensaje: "Las cimas deben tener letras o numeros y no usar caracteres raros.",
      validar: function(valor) {
        return validarTextoRuta(valor, 2, 150);
      }
    },
    tiempo: {
      selector: 'input[name="tiempo"]',
      mensaje: "El tiempo debe ser un numero mayor que 0.",
      validar: function(valor) {
        const numero = Number(valor.replace(",", "."));
        return valor.trim() !== "" && Number.isFinite(numero) && numero > 0 && numero <= 999;
      }
    }
  };

  document.querySelectorAll("form").forEach(function(formulario) {
    const campos = Object.values(reglas)
      .map(function(regla) {
        const campo = formulario.querySelector(regla.selector);
        return campo ? { campo: campo, regla: regla } : null;
      })
      .filter(Boolean);

    if (campos.length === 0) {
      return;
    }

    campos.forEach(function(item) {
      item.campo.addEventListener("input", function() {
        validarCampo(item.campo, item.regla);
      });

      item.campo.addEventListener("blur", function() {
        validarCampo(item.campo, item.regla);
      });
    });

    formulario.addEventListener("submit", function(evento) {
      const resultados = campos.map(function(item) {
        return validarCampo(item.campo, item.regla);
      });
      const valido = resultados.every(Boolean);

      if (!valido) {
        evento.preventDefault();
        campos.find(function(item) {
          return item.campo.classList.contains("is-invalid");
        }).campo.focus();
      }
    });
  });

  function validarTexto(valor, patron, minimo, maximo) {
    const texto = valor.trim();
    return texto.length >= minimo && texto.length <= maximo && patron.test(texto);
  }

  function validarTextoRuta(valor, minimo, maximo) {
    const texto = valor.trim();
    const patron = /^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ0-9][A-Za-zÁÉÍÓÚÜÑáéíóúüñ0-9\s.,;:()\/ºª'°-]*$/;
    const tieneLetraONumero = /[A-Za-zÁÉÍÓÚÜÑáéíóúüñ0-9]/.test(texto);

    return texto.length >= minimo && texto.length <= maximo && patron.test(texto) && tieneLetraONumero;
  }

  function validarCampo(campo, regla) {
    const correcto = regla.validar(campo.value);
    const mensaje = obtenerMensaje(campo);

    campo.classList.toggle("is-invalid", !correcto);
    campo.classList.toggle("is-valid", correcto);
    mensaje.textContent = correcto ? "" : regla.mensaje;

    return correcto;
  }

  function obtenerMensaje(campo) {
    let mensaje = campo.parentElement.querySelector(".invalid-feedback");

    if (!mensaje) {
      mensaje = document.createElement("div");
      mensaje.className = "invalid-feedback";
      campo.insertAdjacentElement("afterend", mensaje);
    }

    return mensaje;
  }
});
