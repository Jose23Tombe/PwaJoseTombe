if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('../service-worker.js')
      .then((registro) => {
        console.log('✅ Service Worker registrado correctamente:', registro.scope);
      })
      .catch((error) => {
        console.error('❌ Error al registrar el Service Worker:', error);
      });
  });
} else {
  console.warn('⚠️ Este navegador no soporta Service Workers.');
}
