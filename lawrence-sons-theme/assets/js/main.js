/**
 * Lawrence & Sons – Main JS
 * Mobile menu toggle + smooth-scroll link closing.
 */
(function () {
    'use strict';

    const toggle    = document.getElementById('navToggle');
    const mobile    = document.getElementById('navMobile');
    const openIcon  = toggle?.querySelector('.nav-toggle-open');
    const closeIcon = toggle?.querySelector('.nav-toggle-close');

    if (!toggle || !mobile) return;

    function setMenu(open) {
        mobile.classList.toggle('open', open);
        toggle.setAttribute('aria-expanded', String(open));
        if (openIcon)  openIcon.style.display  = open ? 'none' : '';
        if (closeIcon) closeIcon.style.display = open ? ''     : 'none';
    }

    toggle.addEventListener('click', function () {
        const isOpen = mobile.classList.contains('open');
        setMenu(!isOpen);
    });

    /* Close mobile menu when a nav link is clicked */
    mobile.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            setMenu(false);
        });
    });
})();
