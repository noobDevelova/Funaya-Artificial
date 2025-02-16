<script>
    $(document).ready(function() {
        $(document).on("submit", "#editStaffForm", function(e) {
            e.preventDefault();

            let $form = $(this);
            let formData = {
                id: <?= $user->id; ?>,
                username: $form.find("input[name='username']").val(),
                role_id: $form.find("select[name='role']").val(),
                email: $form.find("input[name='email']").val(),
                phone_number: $form.find("input[name='phone_number']").val(),
            };

            $(".error-message").text("");
            $(".submit-button")
                .addClass("opacity-50 cursor-not-allowed")
                .prop("disabled", true);

            $.ajax({
                url: "<?= site_url('staff/update') ?>",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function(response) {
                    if (response.status === "success") {
                        Toastify({
                            text: "Staff Berhasil Diubah",
                            style: {
                                background: "rgb(126 58 242 / var(--tw-bg-opacity, 1))",
                                borderRadius: "10px",
                            },
                        }).showToast();

                        setTimeout(() => {
                            window.location.href = "/staff";
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        console.log(xhr.responseJSON);
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