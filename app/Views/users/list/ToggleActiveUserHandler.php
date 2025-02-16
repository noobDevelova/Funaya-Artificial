<script>
    $(document).ready(function() {
        $(document).on("change", ".toggle-switch", function() {
            let $switch = $(this);

            let id = $switch.data("id");

            $.ajax({
                url: "<?= site_url('staff/toggle-active') ?>",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    id: id
                }),
                success: function(response) {
                    if (response.status === "success") {
                        Toastify({
                            text: "Status berhasil diubah",
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