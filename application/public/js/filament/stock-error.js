// Pastikan SweetAlert2 sudah tersedia (kita load lewat provider di langkah 3)
window.addEventListener('notify-stock-error', (event) => {
    const message = event.detail?.message ?? 'Terjadi kesalahan stok.';
    if (window.Swal) {
        Swal.fire({
            icon: 'error',
            title: 'Stok Tidak Cukup',
            text: message,
            confirmButtonText: 'OK',
        });
    } else {
        alert(message);
    }
});
