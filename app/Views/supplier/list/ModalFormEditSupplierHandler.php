<script>
    function getSupplier(supplierSlug) {

        $(".input-form").prop('disabled', true)

        $('#supplier_id').val('')
        $('#supplier_slug').val('')

        $('#supplier_name').val('')
        $('#supplier_contact_person').val('')
        $('#supplier_phone').val('')
        $('#supplier_email').val('')
        $('#supplier_address').val('')

        $.ajax({
            url: `<?= site_url('supplier/') ?>${supplierSlug}`,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                const {
                    data
                } = response

                $('#supplier_id').val(data.id)
                $('#supplier_slug').val(data.slug)

                $('#supplier_name').val(data.name)
                $('#supplier_contact_person').val(data.contactPerson)
                $('#supplier_phone').val(data.phone)
                $('#supplier_email').val(data.email)
                $('#supplier_address').val(data.address)
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan: ', error);
            },
            complete: function() {
                $(".input-form").prop("disabled", false);
            }
        })
    }

    $(document).ready(function() {
        $(document).on("submit", "#editSupplierForm", function(e) {
            e.preventDefault();

            const modalEl = document.querySelector('[x-data]');
            modalEl.__x.$data.isModalLoading = true;

            let $form = $(this);
            let slug = $form.find("input[name='slug']").val()

            let formData = {
                id: $form.find("input[name='id']").val(),
                name: $form.find("input[name='name']").val(),
                contact_person: $form.find("input[name='contact_person']").val(),
                phone: $form.find("input[name='phone']").val(),
                email: $form.find("input[name='email']").val(),
                address: $form.find("input[name='address']").val(),
            };

            $(".error-message-modal").text("");
            $(".submit-button-modal")
                .addClass("opacity-50 cursor-not-allowed")
                .prop("disabled", true);

            $.ajax({
                url: `<?= site_url('supplier/') ?>${slug}/edit`,
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function(response) {
                    console.log(response)
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