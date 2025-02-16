<script>
    $(document).ready(function() {
        $(document).on("submit", "#createCategoriesForm", function(e) {
            e.preventDefault();

            let $form = $(this);
            let formData = {
                name: $form.find("input[name='name']").val(),
                description: $form.find("textarea[name='description']").val(),
            };

            $(".error-message").text("");
            $(".submit-button")
                .addClass("opacity-50 cursor-not-allowed")
                .prop("disabled", true);

            $.ajax({
                url: "<?= site_url('categories/create') ?>",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function(response) {
                    if (response.status === "success") {
                        Toastify({
                            text: "Kategori Berhasil Ditambahkan",
                            style: {
                                background: "rgb(126 58 242 / var(--tw-bg-opacity, 1))",
                                borderRadius: "10px",
                            },
                        }).showToast();

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        if (
                            xhr.responseJSON.errors &&
                            Object.keys(xhr.responseJSON.errors).length > 0
                        ) {
                            for (let field in xhr.responseJSON.errors) {
                                $(`#${field}-error`).text(xhr.responseJSON.errors[field]);
                            }
                        }
                    } else {
                        Toastify({
                            text: "Terjadi Kesalahan",
                            style: {
                                background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                                borderRadius: "10px",
                            },
                        }).showToast();
                    }

                    $(".submit-button")
                        .removeClass("opacity-50 cursor-not-allowed")
                        .prop("disabled", false);
                },
            });
        });
    });
</script>