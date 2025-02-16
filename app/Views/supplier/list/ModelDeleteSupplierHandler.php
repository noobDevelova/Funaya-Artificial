<script>
    function deleteSupplier(slug) {
        const modalEl = document.querySelector('[x-data]');
        modalEl.__x.$data.isModalConfirmLoading = true;

        $.ajax({
            url: `<?= site_url('supplier') ?>/${slug}/delete`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                slug: slug
            }),
            success: function(response) {
                if (response.status === 'success') {
                    Toastify({
                        text: "Supplier Berhasil Dihapus",
                        style: {
                            background: "rgb(126 58 242 / var(--tw-bg-opacity, 1))",
                            borderRadius: '10px'
                        }
                    }).showToast();

                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    Toastify({
                        text: `Supplier Gagal Dihapus`,
                        style: {
                            background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                            borderRadius: '10px'
                        }
                    }).showToast();

                    const modalEl = document.querySelector('[x-data]');
                    modalEl.__x.$data.isModalConfirmLoading = false;
                }
            },
            error: function(xhr, status, error) {
                Toastify({
                    text: "Terjadi kesalahan saat menghapus data!",
                    style: {
                        background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                        borderRadius: '10px'
                    }
                }).showToast();

                const modalEl = document.querySelector('[x-data]');
                modalEl.__x.$data.isModalConfirmLoading = false;
            }
        });
    }
</script>