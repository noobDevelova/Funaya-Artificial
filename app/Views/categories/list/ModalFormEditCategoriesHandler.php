<script>
    function getCategories(categoriesSlug) {
        $.ajax({
            url: `<?= site_url('categories/') ?>${categoriesSlug}`,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                const {
                    data
                } = response

                $('#category_name').val(data.name)
                $('#category_description').val(data.description)
                $('#category_id').val(data.id)
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan: ', error);
            }
        })
    }

    $(document).ready(function() {
        $(document).on("submit", "#editCategoriesForm", function(e) {
            e.preventDefault();

            const modalEl = document.querySelector('[x-data]');
            modalEl.__x.$data.isModalLoading = true;

            let $form = $(this);
            let formData = {
                id: $form.find("input[name='id']").val(),
                name: $form.find("input[name='name']").val(),
                description: $form.find("textarea[name='description']").val(),
            };

            $(".error-message-modal").text("");
            $(".submit-button-modal")
                .addClass("opacity-50 cursor-not-allowed")
                .prop("disabled", true);

            $.ajax({
                url: "<?= site_url('categories/update') ?>",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function(response) {
                    if (response.status === "success") {
                        Toastify({
                            text: "Kategori Berhasil Diubah",
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
                                $(`#${field}-error-modal`).text(xhr.responseJSON.errors[field]);
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

                    modalEl.__x.$data.isModalLoading = false;

                    $(".submit-button-modal")
                        .removeClass("opacity-50 cursor-not-allowed")
                        .prop("disabled", false);
                },
            });
        });
    });
</script>