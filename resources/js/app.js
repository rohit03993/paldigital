import './bootstrap';
import { initPwaInstall } from './pwa-install';

initPwaInstall();

if ('serviceWorker' in navigator && !window.location.pathname.startsWith('/admin')) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {});
    });
}
