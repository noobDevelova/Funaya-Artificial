<script>
    $(document).ready(function() {
        $(document).on("submit", "#loginForm", function(e) {
            e.preventDefault();

            let $form = $(this);
            let formData = {
                email: $form.find("input[name='email']").val(),
                password: $form.find("input[name='password']").val(),
            };

            $(".error-message").text("");
            $(".submit-button").addClass("opacity-50 cursor-not-allowed").prop("disabled", true);

            $.ajax({
                url: "<?= site_url('auth/login') ?>",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function(response) {
                    if (response.status === "success") {
                        window.location.href = "/";
                    }
                },
                error: function(xhr) {
                    console.log(xhr)
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        if (xhr.responseJSON.errors && Object.keys(xhr.responseJSON.errors)
                            .length > 0) {
                            for (let field in xhr.responseJSON.errors) {
                                $(`#${field}-error`).text(xhr.responseJSON.errors[field]);
                            }
                        }

                        if (xhr.responseJSON.error_code) {
                            let errorMessage = xhr.responseJSON.message;

                            switch (xhr.responseJSON.error_code) {
                                case "INVALID_PASSWORD":
                                    errorMessage =
                                        "Password yang Anda masukkan salah.";
                                    break;
                                case "ACCOUNT_NOT_FOUND":
                                    errorMessage = "Akun tidak ditemukan.";
                                    break;
                                case "ACCOUNT_NOT_ACTIVE":
                                    errorMessage =
                                        "Akun tidak aktif. Silakan hubungi administrator.";
                                    break;
                                default:
                                    errorMessage = "Kesalahan tidak terduga terjadi.";
                            }

                            $("#general-error").text(errorMessage);
                        }
                    } else {
                        Toastify({
                            text: "Terjadi Kesalahan Saat Login",
                            style: {
                                background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                                borderRadius: '10px'
                            }
                        }).showToast();
                    }
                },
                complete: function() {
                    $(".submit-button").removeClass("opacity-50 cursor-not-allowed").prop(
                        "disabled", false);
                },
            });
        });
    });
</script>