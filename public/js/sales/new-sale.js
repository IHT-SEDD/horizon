function addProduct() {
    const productContainer = document.getElementById("product-container");
    const addButton = document.getElementById("add_other_product");

    let productIndex = 0;

    function createProductRow(index) {
        const row = document.createElement("div");
        row.className = "product-row flex items-center gap-4 w-full";

        const selectId = `select-one-product-${index}`;

        row.innerHTML = `<label class="form-control w-full">
            <div class="label">
                <span class="label-text capitalize">Product <span class="text-error text-sm">*</span></span>
            </div>
            <select class="w-full max-w-full tom-select" id="${selectId}" name="product_id[]"></select>
        </label>
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text capitalize">Quantity <span class="text-error text-sm">*</span></span>
            </div>
            <input name="qty[]" type="text" placeholder="Input quantity product" class="input input-bordered input-sm w-full" />
        </label>
        <div class="pt-[33px]">
            <button class="btn btn-sm text-base-100 btn-error delete-product" type="button">
                <i data-lucide="trash" width="13" height="13"></i>
            </button>
        </div>
        `;
        return { row, selectId };
    }

    addButton.addEventListener("click", () => {
        const { row, selectId } = createProductRow(productIndex++);
        productContainer.appendChild(row);
        lucide.createIcons();
        TomSelectConfig.init(
            "/master/product/select",
            `#${selectId}`,
            "Choose product..."
        );
    });

    productContainer.addEventListener("click", (e) => {
        if (e.target.closest(".delete-product")) {
            const row = e.target.closest(".product-row");
            if (row) {
                row.remove();
            }
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    DateRangePicker.init({
        selector: "#expiration_date_picker",
        onChange: (start, end) => absentDt.setDateRange(start, end),
    });

    TomSelectConfig.init(
        "/master/payment-term/select",
        "#select-one-payment-term",
        "Choose payment term..."
    );

    TomSelectConfig.init(
        "/master/customer/select",
        "#select-one-customer",
        "Choose customer..."
    );

    TomSelectConfig.init(
        "/master/product/select",
        "#select-one-product",
        "Choose product..."
    );

    addProduct();
});
