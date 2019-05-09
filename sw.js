const cacheName = 'nossabanda-v1';
const cacheAssets = [
	'assets/css/sb-admin.css',
	'assets/js/',
	'assets/images/icon/',
];

// install
self.addEventListener('install', e => {
	e.waitUntil(
        caches
            .open(cacheName)
            .then(cache => {
                console.log('Service Worker: Caching files');
                cache.addAll(cacheAssets);
            })
            .then(() => self.skipWaiting())
    );
});

// activate
self.addEventListener('activate', e => {
	e.waitUntil(
		caches.keys().then(cacheNames => {
			return Promise.all(
				cacheNames.map(cache => {
					if (cache !== cacheName) {
						return caches.delete(cache);
					}
				})
			)
		})
	);
});