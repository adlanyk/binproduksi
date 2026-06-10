document.addEventListener('alpine:init', () => {
    window.Livewire.on('notify-stock-error', (event) => {
        Swal.fire({
            icon: 'error',
            title: 'Stok Tidak Cukup',
            text: event.message,
            confirmButtonText: 'OK'
        });
    });
});
