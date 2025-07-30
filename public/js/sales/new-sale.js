let sales_order, products, wizard_form_data, validationMessages, validator;

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// Init store data
products = {};
wizard_form_data = {};

// Store data from form step 1
const form_step_1 = {
    sales_order: {},
};
// Store data from form step 2
const form_step_2 = {
    products: [],
};

// FORM STEP 1
function formStep1() {
    const selectCustomer = $("#select-one-customer");
    const selectExpirationDate = $("#expiration_date_picker");
    const selectPaymentTerm = $("#select-one-payment-term");
    const nextStepToStep2Btn = $("#next_to_step_2");
    const clearStepBtn = $("#clear_step_1");
    let selectedExpirationDate = "";

    DateRangePicker.init({
        selector: "#expiration_date_picker",
        onChange: (start) => {
            selectedExpirationDate = start;
        },
    });
    TomSelectConfig.init({
        url: "/master/payment-term/select",
        selector: "#select-one-payment-term",
        placeholder: "Choose payment term...",
    });
    TomSelectConfig.init({
        url: "/master/customer/select",
        selector: "#select-one-customer",
        placeholder: "Choose customer...",
    });

    // Validator inputs
    validator = {
        customer_id: { required: true },
        expiration_date: { required: true },
        payment_term_id: { required: true },
    };
    // Validator messages
    validationMessages = {
        customer_id: { required: "Customer is required" },
        expiration_date: { required: "Expiration date is required" },
        payment_term_id: { required: "Payment term is required" },
    };

    // Init form validation to form step 1
    FormValidator.init("#form_step_1", validator, validationMessages);

    // Function add products to JSON
    nextStepToStep2Btn.on("click", (e) => {
        e.preventDefault();

        // Callback if validation is error
        if (!$("#form_step_1").valid()) return;

        const customerId = selectCustomer.val();
        const expirationDate = selectedExpirationDate;
        const paymentTerm = selectPaymentTerm.val();

        // Insert data to JSON
        form_step_1.sales_order = {
            customer_id: customerId,
            customer_value: selectCustomer.text(),
            expiration_date: expirationDate,
            payment_term_id: paymentTerm,
            payment_term_value: selectPaymentTerm.text(),
        };

        // Log the form_step_1 data
        console.log(form_step_1);

        // Reset inputs if add data succeed
        if (selectCustomer[0]?.tomselect) {
            selectCustomer[0]?.tomselect.clear();
        }
        if (selectExpirationDate[0]?.tomselect) {
            selectExpirationDate[0]?.tomselect.clear();
        }
        if (selectPaymentTerm[0]?.tomselect) {
            selectPaymentTerm[0]?.tomselect.clear();
        }

        WizardForm.next();
    });

    // Function clear form
    document
        .getElementById("clear_step_1")
        .addEventListener("click", function () {
            WizardForm.clearStep(1);
        });
}

// FORM STEP 2
function formStep2() {
    const selectProduct = $("#select-one-product");
    const qtyInput = $("#quantity");
    const addBtn = $("#add_product_btn");
    const productTableBody = document.getElementById("product-table-body");

    TomSelectConfig.init({
        url: "/master/product/select",
        selector: "#select-one-product",
        placeholder: "Choose product...",
    });

    const validator = {
        product_id: { required: true },
        quantity: { required: true, number: true },
    };

    const validationMessages = {
        product_id: { required: "Product is required" },
        quantity: {
            required: "Quantity is required",
            number: "Quantity must be a number",
        },
    };

    FormValidator.init("#form_step_2", validator, validationMessages);

    function updateSummary() {
        let untaxedAmount = 0;
        let taxAmount = 0;

        for (const product of form_step_2.products) {
            const price = product.product_detail.sales_price || 0;
            const quantity = product.quantity || 0;
            const discount = product.discount || 0;
            const taxPercent = product.tax_rate || 0;

            const lineSubtotal = price * quantity;
            const discountAmount = (lineSubtotal * discount) / 100;
            const subtotalAfterDiscount = lineSubtotal - discountAmount;
            const lineTax = (subtotalAfterDiscount * taxPercent) / 100;

            product.subtotal = subtotalAfterDiscount + lineTax;

            untaxedAmount += subtotalAfterDiscount;
            taxAmount += lineTax;
        }

        const totalAmount = untaxedAmount + taxAmount;

        form_step_1.sales_order.untaxed_amount = untaxedAmount;
        form_step_1.sales_order.tax_amount = taxAmount;
        form_step_1.sales_order.total_amount = totalAmount;

        $("#untaxed_amount").text(rupiahFormatter.init(untaxedAmount));
        $("#tax_amount").text(rupiahFormatter.init(taxAmount));
        $("#total_amount").text(rupiahFormatter.init(totalAmount));
    }

    function createProductRow(product, quantity, productDetail) {
        const row = document.createElement("tr");
        row.dataset.productId = product.id;

        row.innerHTML = `
            <td class="text-xs">${product.name}</td>
            <td class="text-xs">${quantity}</td>
            <td class="text-xs">${rupiahFormatter.init(
                productDetail.sales_price
            )}</td>
            <td class="text-xs">
                <select class="w-full max-w-full tom-select tax-select" name="tax_id"></select>
            </td>
            <td class="text-xs">
                <input name="discount_product" type="text" placeholder="Input discount" class="input input-bordered input-sm w-1/2" />
            </td>
            <td>
                <button class="btn btn-sm btn-secondary edit-product"><i data-lucide="pencil" width="11" height="11"></i></button>
                <button class="btn btn-sm btn-error delete-product"><i data-lucide="trash" width="11" height="11"></i></button>
            </td>
        `;

        productTableBody.appendChild(row);

        const taxSelect = row.querySelector("select.tax-select");
        const discountInput = row.querySelector(
            "input[name='discount_product']"
        );

        form_step_2.products.push({
            id: product.id,
            name: product.name,
            quantity: quantity,
            tax_id: "",
            tax_name: "",
            tax_rate: 0,
            discount: 0,
            product_detail: productDetail,
        });

        const productIndex = () =>
            Array.from(productTableBody.children).indexOf(row);

        // Init Tax Dropdown with onChange handler
        TomSelectConfig.init({
            url: "/master/tax/select",
            selector: taxSelect,
            placeholder: "Choose tax...",
            onChange: (value, selected) => {
                const idx = productIndex();
                if (form_step_2.products[idx]) {
                    form_step_2.products[idx].tax_id = value;
                    form_step_2.products[idx].tax_name = selected.text;
                    form_step_2.products[idx].tax_rate = parseFloat(
                        selected.nominal || 0
                    );
                    updateSummary();
                }
            },
        });

        // Discount handler
        discountInput.addEventListener("input", () => {
            const idx = productIndex();
            if (form_step_2.products[idx]) {
                form_step_2.products[idx].discount = discountInput.value || "0";
                updateSummary();
            }
        });

        // Delete handler
        row.querySelector(".delete-product").addEventListener("click", () => {
            const idx = productIndex();
            if (idx > -1) {
                form_step_2.products.splice(idx, 1);
                row.remove();
                updateSummary();
            }
        });

        // Edit handler
        row.querySelector(".edit-product").addEventListener("click", () => {
            const idx = productIndex();
            const productData = form_step_2.products[idx];

            selectProduct.val(productData.id);
            qtyInput.val(productData.quantity);

            if (selectProduct[0]?.tomselect) {
                selectProduct[0].tomselect.setValue(productData.id);
            }

            form_step_2.products.splice(idx, 1);
            row.remove();
            updateSummary();
        });

        if (window.lucide) lucide.createIcons();
        updateSummary();
    }

    // Add product handler
    addBtn.on("click", (e) => {
        e.preventDefault();
        if (!$("#form_step_2").valid()) return;

        const productId = selectProduct.val();
        const productName = selectProduct[0]?.selectedOptions[0]?.text || "";
        const quantity = parseFloat(qtyInput.val().trim());

        const existingIndex = form_step_2.products.findIndex(
            (p) => p.id === productId
        );

        if (existingIndex !== -1) {
            const updatedQty =
                parseFloat(form_step_2.products[existingIndex].quantity) +
                quantity;
            form_step_2.products[existingIndex].quantity = String(updatedQty);

            const existingRow = productTableBody.children[existingIndex];
            existingRow.children[1].textContent = updatedQty;
            updateSummary();
            return;
        }

        // GET product detail
        $.ajax({
            url: "/sales/add-new/products/details",
            method: "GET",
            data: { ids: [productId] },
            dataType: "json",
            success: function (productDetailsMap) {
                const productDetail = productDetailsMap[productId];
                if (!productDetail) {
                    notyf.error("Product not found!");
                    return;
                }

                createProductRow(
                    { id: productId, name: productName },
                    quantity,
                    productDetail
                );

                qtyInput.val("");
                if (selectProduct[0]?.tomselect) {
                    selectProduct[0].tomselect.clear();
                }

                console.log("Product Added:", form_step_2.products);
            },
            error: function (xhr, status, error) {
                console.error("Gagal ambil detail produk:", error);
                notyf.error("Failed to fetch product!");
            },
        });
    });

    // Function clear form
    document
        .getElementById("clear_step_2")
        .addEventListener("click", function () {
            // Call general field clear from WizardForm
            WizardForm.clearStep(2);

            // Step 2 specific clearing logic
            form_step_2.products = [];
            document.getElementById("product-table-body").innerHTML = "";

            form_step_1.sales_order.untaxed_amount = 0;
            form_step_1.sales_order.tax_amount = 0;
            form_step_1.sales_order.total_amount = 0;

            $("#untaxed_amount").text("Rp0");
            $("#tax_amount").text("Rp0");
            $("#total_amount").text("Rp0");
        });

    $("#final_submit").on("click", (e) => {
        e.preventDefault();

        const wizard_form_data = {
            form_step_1: form_step_1,
            form_step_2: form_step_2,
        };
        console.log("Final Data:", wizard_form_data);

        $("#final_submit").attr("disabled", true).text("Submitting...");

        $.ajax({
            url: "/sales/add-new/insert-data",
            method: "POST",
            data: wizard_form_data,
            dataType: "json",
            success: function (response) {
                console.log("Success:", response);
                WizardForm.next();

                // Optional: Show success UI
                notyf.success(response.message);

                // Reset form data or redirect
                $("#final_submit").attr("disabled", false).text("Submit");
            },
            error: function (xhr) {
                const res = xhr.responseJSON;

                if (res?.message) {
                    notyf.error(res.message);
                }

                const errors = res?.errors || {};
                for (let field in errors) {
                    notyf.error(`${field}: ${errors[field][0]}`);
                }
                $("#final_submit").attr("disabled", false).text("Submit");
            },
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    WizardForm.initStepper(["step_1", "step_2", "final_step"]);
    formStep1();
    formStep2();
});
