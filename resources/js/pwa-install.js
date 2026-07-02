const STORAGE_KEY = 'pal-pwa-install-dismissed';

function isStandalone() {
    return (
        window.matchMedia('(display-mode: standalone)').matches ||
        window.navigator.standalone === true
    );
}

function isIos() {
    return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
}

function isMobile() {
    return window.matchMedia('(max-width: 1023px)').matches;
}

function isDismissed() {
    const dismissedAt = localStorage.getItem(STORAGE_KEY);

    if (!dismissedAt) {
        return false;
    }

    const daysSinceDismiss = (Date.now() - Number(dismissedAt)) / (1000 * 60 * 60 * 24);

    return daysSinceDismiss < 14;
}

function maybeShowBanner(store) {
    if (store.isStandalone || isDismissed() || !store.canShowInstall || !isMobile()) {
        return;
    }

    setTimeout(() => {
        if (!isDismissed() && store.canShowInstall && !store.isStandalone) {
            store.showBanner = true;
        }
    }, 4000);
}

function applyDeferredPrompt(store, event) {
    event.preventDefault();
    store.deferredPrompt = event;
    store.canInstall = true;
    maybeShowBanner(store);
}

function registerPwaStore() {
    document.addEventListener('alpine:init', () => {
        Alpine.store('pwa', {
            deferredPrompt: null,
            canInstall: false,
            isIos: isIos(),
            isStandalone: isStandalone(),
            showBanner: false,
            showInstructions: false,
            instructionType: 'android',

            get canShowInstall() {
                if (this.isStandalone) {
                    return false;
                }

                if (this.canInstall || this.isIos) {
                    return true;
                }

                return isMobile() && 'serviceWorker' in navigator;
            },

            dismissBanner() {
                this.showBanner = false;
                localStorage.setItem(STORAGE_KEY, Date.now().toString());
            },

            openInstall() {
                if (this.isStandalone) {
                    return;
                }

                if (this.canInstall && this.deferredPrompt) {
                    this.deferredPrompt.prompt();
                    this.deferredPrompt.userChoice.then(() => {
                        this.deferredPrompt = null;
                        this.canInstall = false;
                        this.showBanner = false;
                    });

                    return;
                }

                this.instructionType = this.isIos ? 'ios' : 'android';
                this.showInstructions = true;
            },

            closeInstructions() {
                this.showInstructions = false;
            },
        });

        const store = Alpine.store('pwa');

        if (window.__pwaDeferredPrompt) {
            applyDeferredPrompt(store, window.__pwaDeferredPrompt);
            window.__pwaDeferredPrompt = null;
        } else if (store.canShowInstall && isMobile()) {
            maybeShowBanner(store);
        }
    });
}

export function initPwaInstall() {
    if (window.location.pathname.startsWith('/admin')) {
        return;
    }

    registerPwaStore();

    window.addEventListener('beforeinstallprompt', (event) => {
        if (window.Alpine?.store('pwa')) {
            applyDeferredPrompt(Alpine.store('pwa'), event);
        } else {
            window.__pwaDeferredPrompt = event;
        }
    });

    window.addEventListener('appinstalled', () => {
        const store = window.Alpine?.store('pwa');

        if (store) {
            store.canInstall = false;
            store.showBanner = false;
            store.isStandalone = true;
        }
    });
}
