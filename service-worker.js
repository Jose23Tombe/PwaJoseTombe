const CACHE_NAME = 'soporte-ti-cache-v1';


const urlsToCache = [
  './',
  './index.html',
  './css/style.css',
  './icons/icon-192.png',
  './icons/icon-512.png',
  './manifest.json'
];


self.addEventListener('install', event => {
  console.log('📦 Instalando Service Worker y cacheando recursos...');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
      .catch(err => console.error('❌ Error al cachear archivos:', err))
  );
});


self.addEventListener('activate', event => {
  console.log('🧹 Activando nuevo Service Worker...');
  event.waitUntil(
    caches.keys().then(keys => Promise.all(
      keys.map(key => {
        if (key !== CACHE_NAME) return caches.delete(key);
      })
    ))
  );
});


self.addEventListener('fetch', event => {
  const req = event.request;


  if (req.method !== 'GET' || req.url.includes('/php/')) {
    return;
  }

  event.respondWith(
    caches.match(req).then(cachedRes => {

      return cachedRes || fetch(req)
        .then(networkRes => {

          return caches.open(CACHE_NAME).then(cache => {
            cache.put(req, networkRes.clone());
            return networkRes;
          });
        })
        .catch(() => caches.match('./index.html')); 
    })
  );
});
