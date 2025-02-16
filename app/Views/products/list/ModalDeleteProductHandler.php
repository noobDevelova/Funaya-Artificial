<script>
    function deleteProduct(slug) {
        const modalEl = document.querySelector('[x-data]');
        modalEl.__x.$data.isModalConfirmLoading = true;

        $.ajax({
            url: `<?= site_url('products/delete') ?>`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                slug: slug
            }),
            success: function(response) {
                if (response.status === 'success') {
                    Toastify({
                        text: "Produk Berhasil Dihapus",
                        style: {
                            background: "rgb(126 58 242 / var(--tw-bg-opacity, 1))",
                            borderRadius: '10px'
                        }
                    }).showToast();

                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    Toastify({
                        text: `Produk Gagal Dihapus`,
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
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    if (xhr.responseJSON.error_code === 'PRODUCT_STILL_ACTIVE') {
                        Toastify({
                            text: "Produk masih memiliki stok!",
                            style: {
                                background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                                borderRadius: '10px'
                            }
                        }).showToast();
                    }
                } else {
                    Toastify({
                        text: "Terjadi Kesalahan Saat Menghapus Produk",
                        style: {
                            background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                            borderRadius: '10px'
                        }
                    }).showToast();
                }

                const modalEl = document.querySelector('[x-data]');
                modalEl.__x.$data.isModalConfirmLoading = false;
            }
        });
    }
</script>