<script>
        document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-button');
    const orderCards = document.querySelectorAll('.order-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Mengubah style tab yang aktif
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const statusToShow = tab.getAttribute('data-status');

            // Menampilkan atau menyembunyikan kartu pesanan
            orderCards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (statusToShow === 'semua' || statusToShow === cardStatus) {
                    card.style.display = 'block'; // atau 'flex' jika Anda mengubah display card
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
    </script>
