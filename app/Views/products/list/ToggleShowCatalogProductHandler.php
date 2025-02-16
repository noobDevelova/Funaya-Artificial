<script>
    $(document).ready(function() {
        $(document).on("change", ".toggle-switch", function() {
            let $switch = $(this);

            let slug = $switch.data("slug");

            let showOnCatalog = $switch.data("show-on-catalog");

            $.ajax({
                url: "<?= site_url('products/toggle-show-on-catalog') ?>",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    slug: slug
                }),
                success: function(response) {
                    if (response.status === "success") {
                        Toastify({
                            text: `Produk ${showOnCatalog === 1 ? 'Disembunyikan' : 'Ditampilkan'} di Katalog`,
                            style: {
                                background: "rgb(126 58 242 / var(--tw-bg-opacity, 1))",
                                borderRadius: "10px",
                            },
                        }).showToast();

                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    } else {
                        Toastify({
                            text: response.message,
                            style: {
                                background: "rgb(242 58 58 / var(--tw-bg-opacity, 1))",
                            },
                        }).showToast();
                    }
                }
            });
        });
    });
</script>