<script type="text/template" id="template-container">
    <div class="w-full flex flex-col">
        <div class="dz-preview dz-file-preview dz-image-preview flex flex-col items-center justify-center p-1 border-2 border-gray-300 rounded-lg shadow-md bg-gray-800">
            <div class="dz-image mb-4 w-full">
            <img class="object-cover rounded-lg" data-dz-thumbnail />
        </div>

        <div class="dz-details text-center mb-4">
            <div class="dz-filename text-sm font-semibold text-gray-700 dark:text-gray-300">
                <span data-dz-name></span>
            </div>
            <div class="dz-size text-xs text-gray-500 dark:text-gray-400" data-dz-size></div>
        </div>

        <div class="dz-progress w-full bg-gray-200 rounded-full h-1.5 mb-4">
            <span class="dz-upload h-1.5 rounded-full bg-blue-500" data-dz-uploadprogress></span>
        </div>

        <div class="dz-error-message text-xs text-red-500">
            <span data-dz-errormessage></span>
        </div>        
    </div>
</script>

<script>
    Dropzone.options.productImages = {
        url: "<?= site_url('products/update'); ?>",
        autoProcessQueue: false,
        uploadMultiple: false,
        parallelUploads: 1,
        addRemoveLinks: true,
        acceptedFiles: "image/*",
        maxFiles: 1,
        maxFilesMessage: "Anda hanya dapat mengupload satu gambar.",
        previewTemplate: document.querySelector('#template-container').innerHTML,

        init: function() {
            let myDropzone = this;
            const existingImageUrl = '<?= base_url('uploads/products/' . esc($product->coverImage)) ?>';

            if (existingImageUrl) {
                const mockFile = {
                    name: '<?= $product->coverImage ?>',
                    size: 100,
                    url: existingImageUrl
                };
                myDropzone.emit("addedfile", mockFile);
                myDropzone.emit("thumbnail", mockFile, existingImageUrl);
                myDropzone.emit("complete", mockFile);
                myDropzone.files.push(mockFile);
            }

            $('#editProductForm').submit(function(e) {
                e.preventDefault();

                $('.text-red-500').remove();
                $('input, select, textarea').removeClass('border-red-500');

                $(".submit-button")
                    .addClass("opacity-50 cursor-not-allowed")
                    .prop("disabled", true);

                let formData = new FormData();

                if (myDropzone.files.length > 0 && myDropzone.files[0] instanceof File) {
                    formData.append('cover_image', myDropzone.files[0]);
                } else {
                    formData.append('cover_image', '<?= $product->coverImage ?>');
                }


                const productData = {
                    id: <?= $product->id ?>,
                    name: $('input[name="name"]').val(),
                    category_id: $('select[name="category_id"]').val(),
                    minimum_stock: $('input[name="minimum_stock"]').val(),
                    unit: $('select[name="unit"]').val(),
                    price: $('input[name="price"]').val(),
                    color: $('input[name="color"]').val(),
                    size: $('input[name="size"]').val(),
                    material: $('input[name="material"]').val(),
                    description: $('textarea[name="description"]').val(),
                    additional_info: $('textarea[name="additional_info"]').val()
                };

                formData.append('product_data', JSON.stringify(productData));

                console.log("full form: ", formData)
                console.log("image data: ", formData['cover_image'])

                $.ajax({
                    url: myDropzone.options.url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Toastify({
                            text: "Produk Berhasil Diubah!",
                            style: {
                                background: "rgb(126 58 242 / var(--tw-bg-opacity, 1))",
                                borderRadius: '10px'
                            }
                        }).showToast()

                        setTimeout(() => {
                            window.location.href = '/products';
                        }, 500)
                    },
                    error: function(xhr) {
                        Toastify({
                            text: `Produk Gagal Diubah`,
                            style: {
                                background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                                borderRadius: '10px'
                            }
                        }).showToast();

                        if (xhr.status === 400) {
                            let errors = xhr.responseJSON.errors;

                            for (const [key, message] of Object.entries(errors)) {
                                $(`[name="${key}"]`).addClass('border-red-500');
                                $(`[name="${key}"]`).after(
                                    `<span class="text-red-500 text-sm">${message}</span>`);
                            }
                        } else {
                            Toastify({
                                text: `Terjadi Kesalahan Saat Mengubah Produk`,
                                style: {
                                    background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                                    borderRadius: '10px'
                                }
                            }).showToast();
                        }

                        $(".submit-button")
                            .removeClass("opacity-50 cursor-not-allowed")
                            .prop("disabled", false);
                    },
                });
            });
        }
    };
</script>