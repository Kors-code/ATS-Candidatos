document.addEventListener('DOMContentLoaded', function () {
  console.log('[showvacantes] DOMContentLoaded');

  const overlay = document.getElementById('popup-overlay');
  const loading = document.getElementById('popup-loading');
  const messageBox = document.getElementById('popup-message');
  const closeBtn = document.getElementById('popup-close');
  const form = document.getElementById('cvForm');
  if (!overlay || !loading || !messageBox || !closeBtn) {
    console.error('[showvacantes] Elementos del overlay no encontrados:', { overlay, loading, messageBox, closeBtn });
    // No abortamos: podemos seguir si queremos. Pero sin overlay no mostramos nada.
  } else {
    console.log('[showvacantes] Overlay elements OK');
  }

  if (!form) {
    console.error('[showvacantes] Form #cvForm no encontrado en el DOM. Revisa que el id esté correcto.');
    return;
  }

  const submitBtn = form.querySelector('[type="submit"]') || null;
  const spinnerText = loading ? loading.querySelector('p') : null;

  function showOverlay() {
    if (!overlay) return;
    overlay.classList.remove('hidden');
    overlay.style.display = 'flex';
  }
  function hideOverlay() {
    if (!overlay) return;
    overlay.classList.add('hidden');
    overlay.style.display = '';
  }
  function showLoading(msg = 'Enviando tu solicitud, por favor espera...') {
    if (!loading || !messageBox || !closeBtn) return;
    loading.classList.remove('hidden');
    messageBox.classList.add('hidden');
    closeBtn.classList.add('hidden');
    if (spinnerText) spinnerText.textContent = msg;
  }
  function showMessage(type, text) {
    if (!loading || !messageBox || !closeBtn) return;
    loading.classList.add('hidden');
    messageBox.classList.remove('hidden');
    closeBtn.classList.remove('hidden');
    messageBox.innerHTML = '';
    const h = document.createElement('h3');
    h.style.margin = '0';
    if (type === 'success') {
      h.textContent = '✅ ' + text;
      messageBox.appendChild(h);
      const p = document.createElement('p');
      p.textContent = 'Gracias por registrar tu hoja de vida en Sky Free Shop.';
      p.style.marginTop = '10px';
      messageBox.appendChild(p);
    } else {
      h.textContent = '❌ ' + text;
      messageBox.appendChild(h);
    }
  }

  // Mostrar flash si viene desde PHP
  try {
    if (window.popupMessage && window.popupMessage.type && window.popupMessage.text) {
      console.log('[showvacantes] popupMessage detectado', window.popupMessage);
      showOverlay();
      showMessage(window.popupMessage.type, window.popupMessage.text);
    }
  } catch (err) {
    console.error('[showvacantes] Error leyendo window.popupMessage:', err);
  }

  // Evitar doble bind
  if (form.dataset.ajaxBound === '1') {
    console.log('[showvacantes] Form ya enlazado, saliendo.');
    return;
  }
  form.dataset.ajaxBound = '1';

  // Reemplaza el bloque form.addEventListener('submit', ...) existente
form.addEventListener('submit', function (e) {
  console.log('[showvacantes] submit - mostrando overlay y permitiendo envío normal');
  // NO preventDefault(): permitimos que el navegador envíe el form
  showOverlay();
  showLoading();

  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.setAttribute('aria-disabled', 'true');
  }

  // IMPORTANTE: no hacemos XHR ni fetch. El formulario se envía y el backend hará redirect con session('success')
});


  // cerrar overlay
  if (closeBtn) {
    closeBtn.addEventListener('click', function () {
      hideOverlay();
    });
  }

  // cerrar con ESC
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      if (overlay && !overlay.classList.contains('hidden')) hideOverlay();
    }
  });
});
