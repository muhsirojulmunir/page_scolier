/**
 * Animasi landing page Scolier — Motion (motion.dev) v13, API vanilla.
 *
 * Prinsip yang dipakai:
 *  - Hanya `transform` dan `opacity` yang dianimasikan (hemat, tanpa reflow).
 *  - Setiap reveal berjalan sekali saja, supaya tidak berkedip saat digulir naik.
 *  - `prefers-reduced-motion` dihormati: seluruh gerak dilewati, konten
 *    langsung tampil dalam keadaan akhirnya.
 */

import { animate, inView, motionValue, scroll, springValue, stagger, styleEffect } from 'motion';

/* ------------------------------------------------------------------ *
 * Token gerak — satu sumber irama untuk seluruh halaman
 * ------------------------------------------------------------------ */
const EASE_OUT = [0.16, 1, 0.3, 1];

const DURATION = {
    fast: 0.45,
    base: 0.7,
    slow: 0.9,
};

const SPRING = {
    tilt: { type: 'spring', stiffness: 220, damping: 24 },
    settle: { type: 'spring', stiffness: 170, damping: 26 },
};

/* Kartu bahasa 3D di hero */
const TILT = {
    /** Sudut maksimum kemiringan, dalam derajat. */
    maxAngle: 11,
    /** Ketinggian kartu yang sedang disorot kursor. */
    liftZ: 42,
    /** Kartu lain mundur ke belakang supaya tumpukan terasa berlapis. */
    recedeZ: -26,
    spring: { stiffness: 260, damping: 26, mass: 0.9 },
};

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

/** Tampilkan elemen apa adanya — dipakai saat gerak dinonaktifkan. */
function revealInstantly(elements) {
    elements.forEach((el) => {
        el.style.opacity = '1';
        el.style.transform = 'none';
    });
}

/** Jalankan callback sekali saja per elemen. */
function once(el, key, callback) {
    if (el.dataset[key] === 'true') return;
    el.dataset[key] = 'true';
    callback();
}

/* ------------------------------------------------------------------ *
 * 1. Indikator progres baca
 * ------------------------------------------------------------------ */
function initScrollProgress() {
    const bar = document.querySelector('[data-scroll-progress]');
    if (!bar) return;

    scroll(animate(bar, { scaleX: [0, 1] }, { ease: 'linear' }));
}

/* ------------------------------------------------------------------ *
 * 2. Navbar: latar muncul setelah melewati hero + penanda section aktif
 * ------------------------------------------------------------------ */
function initNav() {
    const nav = document.querySelector('[data-nav]');
    const waFloat = document.querySelector('[data-wa-float]');
    if (!nav) return;

    let ticking = false;
    let floatShown = false;

    const update = () => {
        ticking = false;
        const y = window.scrollY;

        nav.classList.toggle('is-scrolled', y > 24);

        // Tombol WA mengambang baru muncul setelah pengguna melewati hero.
        if (waFloat) {
            const shouldShow = y > window.innerHeight * 0.55;

            if (shouldShow !== floatShown) {
                floatShown = shouldShow;
                waFloat.style.pointerEvents = shouldShow ? 'auto' : 'none';

                animate(
                    waFloat,
                    {
                        opacity: shouldShow ? 1 : 0,
                        y: shouldShow ? 0 : 16,
                        scale: shouldShow ? 1 : 0.9,
                    },
                    reduceMotion.matches ? { duration: 0 } : SPRING.settle,
                );
            }
        }
    };

    const onScroll = () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(update);
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    update();

    // --- Penanda section aktif -------------------------------------
    const links = Array.from(document.querySelectorAll('[data-nav-links] a[href^="#"]'));
    if (!links.length) return;

    const setActive = (id) => {
        links.forEach((link) => {
            link.dataset.active = String(link.getAttribute('href') === `#${id}`);
        });
    };

    links.forEach((link) => {
        const section = document.querySelector(link.getAttribute('href'));
        if (!section) return;

        // Pita sempit di tengah viewport: section yang melintasinya dianggap aktif.
        inView(section, () => setActive(section.id), {
            margin: '-45% 0px -45% 0px',
            amount: 0,
        });
    });
}

/* ------------------------------------------------------------------ *
 * 3. Menu mobile
 * ------------------------------------------------------------------ */
function initMobileMenu() {
    const toggle = document.querySelector('[data-menu-toggle]');
    const panel = document.querySelector('[data-menu-panel]');
    if (!toggle || !panel) return;

    const iconOpen = toggle.querySelector('[data-menu-icon-open]');
    const iconClose = toggle.querySelector('[data-menu-icon-close]');
    const items = panel.querySelectorAll('[data-menu-item]');

    let open = false;

    const setOpen = (next) => {
        open = next;
        toggle.setAttribute('aria-expanded', String(next));
        iconOpen?.classList.toggle('hidden', next);
        iconClose?.classList.toggle('hidden', !next);
        toggle.querySelector('.sr-only').textContent = next
            ? 'Tutup menu navigasi'
            : 'Buka menu navigasi';

        // Kunci guliran halaman di belakang panel.
        document.body.style.overflow = next ? 'hidden' : '';

        if (next) {
            panel.hidden = false;

            if (reduceMotion.matches) {
                revealInstantly([panel, ...items]);
                return;
            }

            animate(panel, { opacity: [0, 1] }, { duration: DURATION.fast, ease: EASE_OUT });
            animate(
                items,
                { opacity: [0, 1], y: [18, 0] },
                { duration: DURATION.base, delay: stagger(0.06, { startDelay: 0.08 }), ease: EASE_OUT },
            );
            return;
        }

        if (reduceMotion.matches) {
            panel.hidden = true;
            return;
        }

        // Keluar lebih cepat daripada masuk agar terasa responsif.
        animate(panel, { opacity: [1, 0] }, { duration: 0.22, ease: 'easeIn' }).then(() => {
            if (!open) panel.hidden = true;
        });
    };

    toggle.addEventListener('click', () => setOpen(!open));

    // Menutup lewat tautan, tombol Escape, dan saat layar melebar ke desktop.
    panel.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && open) {
            setOpen(false);
            toggle.focus();
        }
    });

    window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
        if (event.matches && open) setOpen(false);
    });
}

/* ------------------------------------------------------------------ *
 * 4. Hero: masuk bertahap, parallax kartu, dan kemiringan mengikuti kursor
 * ------------------------------------------------------------------ */
function initHero() {
    const heroSection = document.querySelector('#beranda');
    const items = Array.from(document.querySelectorAll('[data-hero-item]'));
    const cards = Array.from(document.querySelectorAll('[data-hero-card]'));
    const cardGroup = document.querySelector('[data-hero-cards]');

    if (reduceMotion.matches) {
        revealInstantly([...items, ...cards]);
        return;
    }

    if (items.length) {
        animate(
            items,
            { opacity: [0, 1], y: [26, 0] },
            {
                duration: DURATION.slow,
                delay: stagger(0.085, { startDelay: 0.1 }),
                ease: EASE_OUT,
            },
        );
    }

    if (!cards.length) return;

    const entrance = animate(
        cards,
        { opacity: [0, 1], y: [34, 0], scale: [0.97, 1] },
        {
            duration: DURATION.slow,
            delay: stagger(0.1, { startDelay: 0.35 }),
            ease: EASE_OUT,
        },
    );

    // Parallax dipasang setelah animasi masuk selesai, supaya keduanya
    // tidak berebut menulis properti `y` pada elemen yang sama.
    entrance.then(() => {
        if (!heroSection) return;

        cards.forEach((card) => {
            const distance = Number(card.dataset.parallax || 0);
            if (!distance) return;

            scroll(animate(card, { y: [0, -distance] }, { ease: 'linear' }), {
                target: heroSection,
                offset: ['start start', 'end start'],
            });
        });
    });

    initCardTilt(cardGroup);
}

/* ------------------------------------------------------------------ *
 * 4b. Kemiringan 3D kartu bahasa mengikuti kursor
 * ------------------------------------------------------------------ */
function initCardTilt(cardGroup) {
    const cards = cardGroup ? [...cardGroup.querySelectorAll('[data-tilt]')] : [];
    if (!cards.length) return;

    // Hanya untuk penunjuk presisi (mouse/trackpad). Di layar sentuh tidak ada
    // kursor untuk diikuti, dan parallax guliran sudah memberi kedalamannya.
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;

    /*
     * Tiap kartu memakai spring permanen yang tinggal di-set nilainya, bukan
     * animate() baru setiap pointermove. Spring menyimpan kecepatannya sendiri,
     * jadi perpindahan arah terasa menyambung dan tidak ada alokasi per frame.
     */
    const controllers = cards.map((card) => {
        // Pembungkus hanya digeser parallax, tidak pernah dimiringkan. Kotaknya
        // stabil, jadi dipakai sebagai acuan posisi kursor — memakai kotak kartu
        // sendiri membuat acuan ikut bergoyang saat kartunya miring.
        const frame = card.parentElement;

        const targetX = motionValue(0);
        const targetY = motionValue(0);
        const targetZ = motionValue(0);

        styleEffect(card, {
            rotateX: springValue(targetX, TILT.spring),
            rotateY: springValue(targetY, TILT.spring),
            z: springValue(targetZ, TILT.spring),
        });

        let frameQueued = false;
        let pending = null;

        // Sorotan digerakkan lewat properti CSS — cukup sekali tulis per frame.
        const applyGlare = () => {
            frameQueued = false;
            if (!pending) return;
            card.style.setProperty('--glare-x', `${pending.x * 100}%`);
            card.style.setProperty('--glare-y', `${pending.y * 100}%`);
        };

        return {
            frame,

            /** Apakah titik kursor berada di dalam kotak pembungkus kartu ini? */
            contains(event) {
                const r = frame.getBoundingClientRect();
                return (
                    event.clientX >= r.left &&
                    event.clientX <= r.right &&
                    event.clientY >= r.top &&
                    event.clientY <= r.bottom
                );
            },

            track(event) {
                const r = frame.getBoundingClientRect();
                const x = (event.clientX - r.left) / r.width;
                const y = (event.clientY - r.top) / r.height;

                // Kursor di atas kartu memiringkannya menjauh dari titik sentuh.
                targetX.set((0.5 - y) * TILT.maxAngle);
                targetY.set((x - 0.5) * TILT.maxAngle);
                targetZ.set(TILT.liftZ);

                card.dataset.active = 'true';

                pending = { x, y };
                if (!frameQueued) {
                    frameQueued = true;
                    requestAnimationFrame(applyGlare);
                }
            },

            /** Mundur ke belakang: dipakai kartu yang sedang tidak disorot. */
            recede() {
                targetX.set(0);
                targetY.set(0);
                targetZ.set(TILT.recedeZ);
                card.dataset.active = 'false';
            },

            reset() {
                targetX.set(0);
                targetY.set(0);
                targetZ.set(0);
                card.dataset.active = 'false';
            },
        };
    });

    /*
     * Satu pendengar di tingkat tumpukan, dan kartu aktif ditentukan dari
     * geometri pembungkus — bukan dari pointerenter/hit-test.
     *
     * Kenapa: kartu yang terangkat membesar karena perspektif, sehingga area
     * hit-test-nya melebar menutupi kartu tetangga. Kalau mengandalkan
     * pointerenter, kartu lama terus menangkap kursor dan menahan dirinya tetap
     * terangkat — kartu tujuan tidak pernah aktif sampai kursor keluar total.
     */
    const onMove = (event) => {
        const activeIndex = controllers.findIndex((controller) => controller.contains(event));

        // Kursor sedang di sela antar kartu: pertahankan keadaan terakhir supaya
        // perpindahan antar kartu tidak berkedip.
        if (activeIndex === -1) return;

        controllers.forEach((controller, index) => {
            if (index === activeIndex) {
                controller.track(event);
            } else {
                controller.recede();
            }
        });
    };

    cardGroup.addEventListener('pointermove', onMove);

    cardGroup.addEventListener('pointerleave', () => {
        controllers.forEach((controller) => controller.reset());
    });
}

/* ------------------------------------------------------------------ *
 * 5. Reveal saat masuk viewport
 * ------------------------------------------------------------------ */
function initReveals() {
    const groups = Array.from(document.querySelectorAll('[data-reveal-group]'));
    const all = Array.from(document.querySelectorAll('[data-reveal]'));

    if (reduceMotion.matches) {
        revealInstantly(all);
        return;
    }

    // Elemen di dalam grup muncul berurutan sebagai satu kesatuan.
    groups.forEach((group) => {
        const items = Array.from(group.querySelectorAll('[data-reveal]'));
        if (!items.length) return;

        inView(
            group,
            () =>
                once(group, 'revealed', () => {
                    animate(
                        items,
                        { opacity: [0, 1], y: [22, 0] },
                        {
                            duration: DURATION.base,
                            delay: stagger(0.07),
                            ease: EASE_OUT,
                        },
                    );
                }),
            { amount: 0.12, margin: '0px 0px -8% 0px' },
        );
    });

    // Sisanya muncul sendiri-sendiri.
    all.filter((el) => !el.closest('[data-reveal-group]')).forEach((el) => {
        inView(
            el,
            () =>
                once(el, 'revealed', () => {
                    animate(
                        el,
                        { opacity: [0, 1], y: [22, 0] },
                        { duration: DURATION.base, ease: EASE_OUT },
                    );
                }),
            { amount: 0.2, margin: '0px 0px -8% 0px' },
        );
    });
}

/* ------------------------------------------------------------------ *
 * 6. Penghitung angka
 * ------------------------------------------------------------------ */
function initCounters() {
    const counters = document.querySelectorAll('[data-count-to]');

    counters.forEach((el) => {
        const target = Number(el.dataset.countTo);
        const suffix = el.dataset.countSuffix || '';
        if (Number.isNaN(target)) return;

        if (reduceMotion.matches) {
            el.textContent = `${target}${suffix}`;
            return;
        }

        el.textContent = `0${suffix}`;

        inView(
            el,
            () =>
                once(el, 'counted', () => {
                    animate(0, target, {
                        duration: 1.3,
                        ease: EASE_OUT,
                        onUpdate: (value) => {
                            el.textContent = `${Math.round(value)}${suffix}`;
                        },
                    });
                }),
            { amount: 0.6 },
        );
    });
}

/* ------------------------------------------------------------------ *
 * 7. Strip sertifikasi berjalan
 * ------------------------------------------------------------------ */
function initMarquee() {
    const track = document.querySelector('[data-marquee]');
    if (!track || reduceMotion.matches) return;

    const firstCopy = track.firstElementChild;
    if (!firstCopy) return;

    const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
    const distance = firstCopy.getBoundingClientRect().width + gap;
    if (distance <= 0) return;

    const playback = animate(
        track,
        { x: [0, -distance] },
        {
            duration: distance / 55, // ~55px per detik: terbaca, tidak mengganggu
            ease: 'linear',
            repeat: Infinity,
        },
    );

    // Berhenti saat disentuh/di-hover supaya teks bisa dibaca.
    const pause = () => playback.pause();
    const play = () => playback.play();

    track.addEventListener('pointerenter', pause);
    track.addEventListener('pointerleave', play);
    track.addEventListener('focusin', pause);
    track.addEventListener('focusout', play);
}

/* ------------------------------------------------------------------ *
 * 8. Garis linimasa yang terisi seiring guliran
 * ------------------------------------------------------------------ */
function initTimeline() {
    const timeline = document.querySelector('[data-timeline]');
    const rail = document.querySelector('[data-timeline-rail]');
    if (!timeline || !rail) return;

    if (reduceMotion.matches) {
        rail.style.transform = 'scaleY(1)';
        return;
    }

    scroll(animate(rail, { scaleY: [0, 1] }, { ease: 'linear' }), {
        target: timeline,
        offset: ['start 78%', 'end 88%'],
    });
}

/* ------------------------------------------------------------------ *
 * 9. Akordeon FAQ
 * ------------------------------------------------------------------ */
function initFaq() {
    document.querySelectorAll('[data-faq-item]').forEach((item) => {
        const trigger = item.querySelector('[data-faq-trigger]');
        if (!trigger) return;

        trigger.addEventListener('click', () => {
            const next = item.dataset.open !== 'true';
            item.dataset.open = String(next);
            trigger.setAttribute('aria-expanded', String(next));
        });
    });
}

/* ------------------------------------------------------------------ *
 * 10. Disclosure (jadwal jam operasional)
 * ------------------------------------------------------------------ */
function initDisclosures() {
    document.querySelectorAll('[data-disclosure]').forEach((item) => {
        const trigger = item.querySelector('[data-disclosure-trigger]');
        if (!trigger) return;

        trigger.addEventListener('click', () => {
            const next = item.dataset.open !== 'true';
            item.dataset.open = String(next);
            trigger.setAttribute('aria-expanded', String(next));
        });
    });
}

/* ------------------------------------------------------------------ *
 * 11. Pemilih bahasa
 * ------------------------------------------------------------------ */
function initLanguageSwitcher() {
    document.querySelectorAll('[data-lang-switcher]').forEach((root) => {
        const trigger = root.querySelector('[data-lang-trigger]');
        const panel = root.querySelector('[data-lang-panel]');
        if (!trigger || !panel) return;

        let open = false;

        const setOpen = (next) => {
            open = next;
            trigger.setAttribute('aria-expanded', String(next));
            root.dataset.open = String(next);

            if (next) {
                panel.hidden = false;

                if (!reduceMotion.matches) {
                    animate(
                        panel,
                        { opacity: [0, 1], y: [-8, 0], scale: [0.97, 1] },
                        { duration: DURATION.fast, ease: EASE_OUT },
                    );
                }
                return;
            }

            if (reduceMotion.matches) {
                panel.hidden = true;
                return;
            }

            animate(panel, { opacity: [1, 0], y: [0, -6] }, { duration: 0.18, ease: 'easeIn' })
                .then(() => {
                    if (!open) panel.hidden = true;
                });
        };

        trigger.addEventListener('click', (event) => {
            event.stopPropagation();
            setOpen(!open);
        });

        // Klik di luar panel menutupnya.
        document.addEventListener('click', (event) => {
            if (open && !root.contains(event.target)) setOpen(false);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && open) {
                setOpen(false);
                trigger.focus();
            }
        });

        // Fokus keyboard yang berpindah keluar panel juga menutupnya.
        root.addEventListener('focusout', () => {
            requestAnimationFrame(() => {
                if (open && !root.contains(document.activeElement)) setOpen(false);
            });
        });
    });
}

/* ------------------------------------------------------------------ *
 * 12. Penampil foto (lightbox)
 * ------------------------------------------------------------------ */
function initLightbox() {
    const box = document.querySelector('[data-lightbox]');
    const triggers = [...document.querySelectorAll('[data-photo-open]')];
    if (!box || !triggers.length) return;

    const image = box.querySelector('[data-lightbox-image]');
    const caption = box.querySelector('[data-lightbox-caption]');
    const figure = box.querySelector('[data-lightbox-figure]');
    const closeBtn = box.querySelector('[data-lightbox-close]');

    // Elemen yang memicu pembukaan, supaya fokus bisa dikembalikan saat ditutup.
    let lastTrigger = null;

    const open = (trigger) => {
        lastTrigger = trigger;
        image.src = trigger.dataset.photoSrc;
        image.alt = trigger.dataset.photoCaption || '';
        caption.textContent = trigger.dataset.photoCaption || '';

        box.hidden = false;
        document.body.style.overflow = 'hidden';
        closeBtn.focus();

        if (reduceMotion.matches) return;

        animate(box, { opacity: [0, 1] }, { duration: DURATION.fast, ease: EASE_OUT });
        animate(
            figure,
            { opacity: [0, 1], scale: [0.94, 1], y: [12, 0] },
            { duration: DURATION.base, ease: EASE_OUT },
        );
    };

    const close = () => {
        document.body.style.overflow = '';
        lastTrigger?.focus();

        if (reduceMotion.matches) {
            box.hidden = true;
            return;
        }

        animate(box, { opacity: [1, 0] }, { duration: 0.2, ease: 'easeIn' }).then(() => {
            box.hidden = true;
        });
    };

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => open(trigger));
    });

    closeBtn.addEventListener('click', close);

    // Klik latar (bukan gambarnya) menutup penampil.
    box.addEventListener('click', (event) => {
        if (!figure.contains(event.target)) close();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !box.hidden) close();
    });
}

/* ------------------------------------------------------------------ *
 * Inisialisasi
 * ------------------------------------------------------------------ */
export function initAnimations() {
    initDisclosures();
    initLanguageSwitcher();
    initLightbox();
    initScrollProgress();
    initNav();
    initMobileMenu();
    initHero();
    initReveals();
    initCounters();
    initMarquee();
    initTimeline();
    initFaq();
}
