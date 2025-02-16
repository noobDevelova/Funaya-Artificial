<script>
    $(document).ready(function() {
        $(document).on("change", ".product-select", function() {
            let selectedOption = $(this).find("option:selected");
            let price = selectedOption.data("price");
            let stock = selectedOption.data("stock");
            $(this).closest(".productRow").find(".price").val(price);
            $(this).closest(".productRow").find(".quantity").val(1);
            $(this).closest(".productRow").find(".total").val(price);
            $(this).closest(".productRow").find(".stock").val(stock);
        });

        $(document).on("input", ".quantity", function() {
            let qty = $(this).val();
            let price = $(this).closest(".productRow").find(".price").val();
            let stock = $(this).closest(".productRow").find(".stock").val();
            let total = qty * price;
            $(this).closest(".productRow").find(".total").val(total);
        });

        $("#addProductButton").click(function() {
            let newProductRow = $(".productRow").first().clone();
            newProductRow.find("select").val("");
            newProductRow.find("input").val("");
            $("#salesItemsContainer").append(newProductRow);
        });

        $(document).on("click", ".remove-product", function() {
            if ($(".productRow").length > 1) {
                $(this).closest(".productRow").remove();
            } else {
                Toastify({
                    text: "Minimal harus ada satu produk!",
                    style: {
                        background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                        borderRadius: "10px",
                    },
                }).showToast();
            }
        });

        $("#createSalesForm").submit(function(e) {
            e.preventDefault();
            let saleItems = [];
            $(".productRow").each(function() {
                let productID = $(this).find(".product-select").val();
                let qty = $(this).find(".quantity").val();
                let price = $(this).find(".price").val();
                let total = $(this).find(".total").val();
                let stock = $(this).find(".stock").val();

                if (qty > stock) {
                    Toastify({
                        text: "Kuantitas Tidak Boleh Lebih Banyak Dari Stok",
                        style: {
                            background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                            borderRadius: "10px",
                        },
                    }).showToast();
                }

                if (productID) {
                    saleItems.push({
                        product_id: productID,
                        quantity: qty,
                        price: price,
                        total: total
                    });
                }
            });

            $.ajax({
                url: "<?= site_url('outgoing-goods/create') ?>",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    sales_items: saleItems
                }),
                success: function(response) {
                    if (response.status === "success") {
                        Toastify({
                            text: "Pembelian Stok Berhasil Dibuat",
                            style: {
                                background: "rgb(126 58 242 / var(--tw-bg-opacity, 1))",
                                borderRadius: "10px",
                            },
                        }).showToast();

                        setTimeout(() => {
                            window.location.href = "/outgoing-goods";
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
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