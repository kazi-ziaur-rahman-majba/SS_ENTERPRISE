self.addEventListener("install", function (event) {
    event.waitUntil(preLoad());
});

var filesToCache = [
    '/',
    '/offline.html',
    '/css/app.css',
    '/assets/css/main.css',
    '/js/app.js',
    '/assets/js/jquery.js',
    '/assets/js/popper.min.js',
    '/assets/js/bootstrap.min.js',
    '/plugins/menu/ma5-menu.min.js',
    '/assets/js/magnific-popup.min.js',
    '/assets/js/appear.js',
    '/assets/js/tilt.jquery.min.js',
    '/assets/js/owl.js',
    '/assets/js/wow.js',
    '/assets/js/odometer.js',
    '/assets/js/jquery-ui.js',
    '/assets/js/script.js',
    '/assets/img/favicon.png'
];

var preLoad = function () {
    return caches.open("offline").then(function (cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener("fetch", function (event) {
    event.respondWith(checkResponse(event.request).catch(function () {
        return returnFromCache(event.request);
    }));
    event.waitUntil(addToCache(event.request));
});

var checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

var addToCache = function (request) {
    return caches.open("offline").then(function (cache) {
        return fetch(request).then(function (response) {
            return cache.put(request, response);
        });
    });
};

var returnFromCache = function (request) {
    return caches.open("offline").then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status == 404) {
                return cache.match("offline.html");
            } else {
                return matching;
            }
        });
    });
};

self.addEventListener('beforeinstallprompt', (event) => {
    // Prevent the mini-infobar from appearing on mobile
    event.preventDefault();
    
    // Stash the event so it can be triggered later
    self.deferredPrompt = event;
    
    // Optionally, notify the user that they can install the PWA
    // You can use any UI/UX approach to notify the user
    console.log('Install prompt triggered');
});
