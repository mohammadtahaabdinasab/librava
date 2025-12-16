(function () {
    // Simple UI controls for Librava: RTL toggle, dark mode, font size, back button
    const htmlEl = document.documentElement;
    const bodyEl = document.body;

    const settingsToggle = document.getElementById('settingsToggle');
    const settingsPanel = document.getElementById('settingsPanel');
    const settingsClose = document.getElementById('settingsClose');
    const settingsBackdrop = document.getElementById('settingsBackdrop');

    const toggleRTL = document.getElementById('toggleRTL');
    const toggleDark = document.getElementById('toggleDark');
    const fontSizeRange = document.getElementById('fontSizeRange');
    const btnReset = document.getElementById('btnResetSettings');
    const backBtn = document.getElementById('backBtn');

    const STORAGE_KEY = 'librava:ui';

    function loadSettings() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            const settings = raw ? JSON.parse(raw) : {};
            // Ensure defaults
            return {
                rtl: settings.rtl || false,
                dark: settings.dark || false,
                lang: settings.lang || 'en',
                fontSize: settings.fontSize || 16
            };
        } catch (e) {
            return {
                rtl: false,
                dark: false,
                lang: 'en',
                fontSize: 16
            };
        }
    }

    function saveSettings(s) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(s));
    }

    function switchLanguage(lang) {
        // Update URL with language parameter
        const url = new URL(window.location);
        url.searchParams.set('lang', lang);
        window.location.href = url.toString();
    }

    function applySettings(s) {
        if (s.rtl) {
            htmlEl.setAttribute('dir', 'rtl');
            htmlEl.setAttribute('lang', s.lang || 'fa');
        } else {
            htmlEl.setAttribute('dir', 'ltr');
            htmlEl.setAttribute('lang', s.lang || 'en');
        }

        if (s.dark) {
            bodyEl.classList.add('theme-dark');
        } else {
            bodyEl.classList.remove('theme-dark');
        }

        if (s.fontSize) {
            htmlEl.style.fontSize = s.fontSize + 'px';
        } else {
            htmlEl.style.fontSize = '';
        }

        // Update UI controls to reflect settings
        toggleRTL.checked = !!s.rtl;
        toggleDark.checked = !!s.dark;
        fontSizeRange.value = s.fontSize || 16;
    }

    function openSettings() {
        settingsPanel.classList.add('open');
        settingsBackdrop.hidden = false;
        settingsPanel.setAttribute('aria-hidden', 'false');
    }

    function closeSettings() {
        settingsPanel.classList.remove('open');
        settingsBackdrop.hidden = true;
        settingsPanel.setAttribute('aria-hidden', 'true');
    }

    // Initialize
    const settings = loadSettings();
    applySettings(settings);

    // Events
    if (settingsToggle) settingsToggle.addEventListener('click', openSettings);
    if (settingsClose) settingsClose.addEventListener('click', closeSettings);
    if (settingsBackdrop) settingsBackdrop.addEventListener('click', closeSettings);

    if (toggleRTL) toggleRTL.addEventListener('change', function () {
        settings.rtl = this.checked;
        // Set the language default when toggling RTL
        settings.lang = this.checked ? 'fa' : 'en';
        applySettings(settings);
        saveSettings(settings);
        
        // Optionally switch language in URL if not already set
        const currentLang = new URL(window.location).searchParams.get('lang');
        if ((this.checked && currentLang !== 'fa') || (!this.checked && currentLang !== 'en')) {
            switchLanguage(settings.lang);
        }
    });

    if (toggleDark) toggleDark.addEventListener('change', function () {
        settings.dark = this.checked;
        applySettings(settings);
        saveSettings(settings);
    });

    if (fontSizeRange) fontSizeRange.addEventListener('input', function () {
        settings.fontSize = parseInt(this.value, 10);
        applySettings(settings);
        saveSettings(settings);
    });

    if (btnReset) btnReset.addEventListener('click', function () {
        localStorage.removeItem(STORAGE_KEY);
        const cleared = {};
        applySettings(cleared);
        saveSettings(cleared);
    });

    // Language switching from navbar dropdown
    document.querySelectorAll('.dropdown-menu a[href*="?lang="]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = new URL(this.href);
            const lang = url.searchParams.get('lang');
            if (lang) {
                switchLanguage(lang);
            }
        });
    });

    if (backBtn) backBtn.addEventListener('click', function () {
        if (window.history.length > 1) {
            window.history.back();
        } else {
            // fallback to home
            window.location.href = '/';
        }
    });

    // Keyboard shortcut: Alt+Shift+S to toggle settings
    window.addEventListener('keydown', function (e) {
        if (e.altKey && e.shiftKey && e.code === 'KeyS') {
            if (settingsPanel.classList.contains('open')) closeSettings(); else openSettings();
        }
    });

    // Small animation on page load
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.card').forEach(function (el, idx) {
            el.style.animationDelay = (idx * 80) + 'ms';
            el.classList.add('fade-in-up');
        });
    });
})();
