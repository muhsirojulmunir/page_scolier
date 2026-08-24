import './bootstrap';
import { initAnimations } from './animations';

/**
 * Jaring pengaman: keadaan awal animasi (opacity 0) hanya dipasang lewat CSS
 * ketika kelas `js` ada di <html>. Kalau inisialisasi gagal karena alasan
 * apa pun, kelas itu dilepas sehingga seluruh konten tetap terbaca.
 */
function start() {
    try {
        initAnimations();
    } catch (error) {
        document.documentElement.classList.remove('js');
        console.error('[scolier] Animasi gagal dimuat:', error);
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', start, { once: true });
} else {
    start();
}
