document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('navToggle');
    const navLinks = document.getElementById('navLinks');

    if (toggle && navLinks) {
        toggle.addEventListener('click', function () {
            navLinks.classList.toggle('open');
        });
        // Tutup menu jika klik di luar
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !navLinks.contains(e.target)) {
                navLinks.classList.remove('open');
            }
        });
    }

    const starInputs = document.querySelectorAll('.star-select input[type="radio"]');
    starInputs.forEach(function (input) {
        if (input.checked) {
            input.parentElement.querySelectorAll('label').forEach(function (lbl, i) {
                const val = parseInt(input.value);
                const lblVal = parseInt(lbl.htmlFor.replace('rating', '')) || (i + 1);
                if (i < val) lbl.style.opacity = '1';
            });
        }
    });
    // Konfirmasi hapus
    const deleteLinks = document.querySelectorAll('.btn-hapus');
    deleteLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (!confirm('Yakin ingin menghapus resensi ini? Tindakan tidak dapat dibatalkan.')) {
                e.preventDefault();
            }
        });
    });
    // Auto-hide alert
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function () { alert.remove(); }, 500);
        }, 4000);
    });
});