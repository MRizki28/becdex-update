const staticCacheName = 'site-static-v2';
const dynamicCache = 'site-dynamic-v1';
const assets = ['/cnryflex/pages/',

'/cnryflex/assets/css/standard.css',
'/cnryflex/assets/css/pages.css',
'/cnryflex/assets/css/tables.css',
'/cnryflex/assets/css/lib/dataTables.css',
'/cnryflex/assets/css/lib/buttons.dataTables.css',
'/cnryflex/assets/css/lib/jquery-ui.css',
'/cnryflex/assets/css/lib/select2.css',

'/cnryflex/assets/js/standard.js',
'/cnryflex/assets/js/user.js',
'/cnryflex/assets/js/lib/jquery.js',
'/cnryflex/assets/js/lib/jquery-ui.js',
'/cnryflex/assets/js/lib/select2.js',
'/cnryflex/assets/js/lib/moment.js',
'/cnryflex/assets/js/lib/sweet.js',
'/cnryflex/assets/js/lib/chart.js',
'/cnryflex/assets/js/lib/dataTables.js',
'/cnryflex/assets/js/lib/jszip.js',
'/cnryflex/assets/js/lib/buttons.html5.js',
'/cnryflex/assets/js/lib/dataTables.buttons.js',
'/cnryflex/assets/js/lib/ckeditor/ckeditor.js',

'/cnryflex/assets/img/tables/sort_asc_disabled.png',
'/cnryflex/assets/img/tables/sort_asc.png',
'/cnryflex/assets/img/tables/sort_both.png',
'/cnryflex/assets/img/tables/sort_desc_disabled.png',
'/cnryflex/assets/img/tables/sort_desc.png',
'/cnryflex/assets/img/loading.gif',

'/cnryflex/assets/font/material/icons.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLCz7Z1JlFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLCz7Z1xlFd2JQEk.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLCz7Z11lFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLDD4Z1JlFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLDD4Z1xlFd2JQEk.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLDD4Z11lFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLDz8Z1JlFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLDz8Z1xlFd2JQEk.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLDz8Z11lFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLEj6Z1JlFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLEj6Z1xlFd2JQEk.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLEj6Z11lFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLGT9Z1JlFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLGT9Z1xlFd2JQEk.woff2',
'/cnryflex/assets/font/poppins/pxiByp8kv8JHgFVrLGT9Z11lFd2JQEl8qw.woff2',
'/cnryflex/assets/font/poppins/pxiEyp8kv8JHgFVrJJbecnFHGPezSQ.woff2',
'/cnryflex/assets/font/poppins/pxiEyp8kv8JHgFVrJJfecnFHGPc.woff2',
'/cnryflex/assets/font/poppins/pxiEyp8kv8JHgFVrJJnecnFHGPezSQ.woff2',
'/cnryflex/pages/offline.html'];

//  Install Service Worker.
self.addEventListener('install', evt => {
    evt.waitUntil(
        caches.open(staticCacheName).then(cache => {
            cache.addAll(assets);
        })
    );
});

//  Active Event.
self.addEventListener('activate', evt => {
    evt.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(
                keys.filter(key => key !== staticCacheName && key !== dynamicCache)
                .map(key => caches.delete(key))
            )
        })
    );
});

//  Fetch Event.
self.addEventListener('fetch', evt => {
    evt.respondWith(
        caches.match(evt.request).then(cacheRes => {
            return cacheRes || fetch(evt.request).then(fetchRes => {
                return caches.open(dynamicCache).then(cache => {
                    cache.put(evt.request.url, fetchRes.clone());
                    return fetchRes;
                })
            });
        }).catch(() => caches.match('/cnryflex/pages/offline.html'))
    );
});