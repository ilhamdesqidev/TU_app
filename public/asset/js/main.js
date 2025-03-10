document.addEventListener("DOMContentLoaded", function(event) {
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
              nav = document.getElementById(navId),
              bodypd = document.getElementById(bodyId),
              headerpd = document.getElementById(headerId);

        // Pastikan semua elemen tersedia
        if (toggle && nav && bodypd && headerpd) {
            // Tambahkan kelas 'show' ke sidebar secara default
            nav.classList.add('show');
            bodypd.classList.add('body-pd');
            headerpd.classList.add('body-pd');

            toggle.addEventListener('click', () => {
                // Toggle kelas 'show' untuk menampilkan/menyembunyikan sidebar
                nav.classList.toggle('show');
                toggle.classList.toggle('bx-x');
                bodypd.classList.toggle('body-pd');
                headerpd.classList.toggle('body-pd');
            });
        }
    };

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');

    /* ===== LINK ACTIVE ===== */
    const linkColor = document.querySelectorAll('.nav_link');

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink));

    // Handle dropdown toggle
    const bookmarkDropdown = document.getElementById('bookmarkDropdown');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownIcon = document.getElementById('dropdownIcon');

    bookmarkDropdown.addEventListener('click', () => {
        dropdownMenu.classList.toggle('show');
        dropdownIcon.classList.toggle('bx-chevron-up');
        dropdownIcon.classList.toggle('bx-chevron-down');
    });
});
