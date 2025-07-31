let urlSplit,
    informationPopulate,
    subInformationPopulate,
    skeleton,
    unSkeleton,
    detailSO,
    updateStatusSalesOrder,
    printSalesOrder;

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// Split the URL
urlSplit = location.pathname.split("/");
const id = urlSplit[3];

// Buttons toolbar
const printBtn = $("#print_btn");
const confirmBtn = $("#confirm_btn");
const cancelBtn = $("#cancel_btn");
const lockBtn = $("#lock_btn");
const deleteBtn = $("#delete_btn");

const exportPdfBtn = $("#export_pdf_btn");
const exportXlsxBtn = $("#export_excel_btn");

// Populate information data
informationPopulate = (data) => {
    const sales_order_data = data.sales_order;

    $(".status_so").text(sales_order_data.status + " /");
    $(".so_number").text(sales_order_data.quotation_number);
    $(".customer_name").text(sales_order_data.customers.name);
    $(".customer_address").text(sales_order_data.customers.address);
    $(".confirmation_date").text(sales_order_data.confirmation_date || "");
    $(".expiration_date").text(sales_order_data.expiration_date || "");
    $(".payment_term").text(sales_order_data.payment_terms.name);
};
// Populate sub information data
subInformationPopulate = (data) => {
    const sales_order_data = data.sales_order;

    $(".description").text(sales_order_data.description);
    $(".untaxed_amount").text(
        rupiahFormatter.init(sales_order_data.untaxed_amount)
    );
    $(".tax_amount").text(rupiahFormatter.init(sales_order_data.tax_amount));
    $(".total_amount").text(rupiahFormatter.init(sales_order_data.grand_total));
};

// Skeleton
skeleton = () => {
    $("#status_number_skeleton").removeClass("hidden");
    $("#status_number_wrapper").addClass("hidden");

    $("#customer_skeleton").removeClass("hidden");
    $("#customer_wrapper").addClass("hidden");

    $("#confirmation_date_skeleton").removeClass("hidden");
    $("#confirmation_date_wrapper").addClass("hidden");

    $("#expiration_date_skeleton").removeClass("hidden");
    $("#expiration_date_wrapper").addClass("hidden");

    $("#payment_term_skeleton").removeClass("hidden");
    $("#payment_term_wrapper").addClass("hidden");

    $("#description_skeleton").removeClass("hidden");
    $("#description_wrapper").addClass("hidden");

    $("#untaxed_amount_skeleton").removeClass("hidden");
    $("#untaxed_amount_wrapper").addClass("hidden");

    $("#tax_amount_skeleton").removeClass("hidden");
    $("#tax_amount_wrapper").addClass("hidden");

    $("#total_amount_skeleton").removeClass("hidden");
    $("#total_amount_wrapper").addClass("hidden");
};

// Un skeleton
unSkeleton = () => {
    $("#status_number_skeleton").addClass("hidden");
    $("#status_number_wrapper").removeClass("hidden");

    $("#customer_skeleton").addClass("hidden");
    $("#customer_wrapper").removeClass("hidden");

    $("#confirmation_date_skeleton").addClass("hidden");
    $("#confirmation_date_wrapper").removeClass("hidden");

    $("#expiration_date_skeleton").addClass("hidden");
    $("#expiration_date_wrapper").removeClass("hidden");

    $("#payment_term_skeleton").addClass("hidden");
    $("#payment_term_wrapper").removeClass("hidden");

    $("#description_skeleton").addClass("hidden");
    $("#description_wrapper").removeClass("hidden");

    $("#untaxed_amount_skeleton").addClass("hidden");
    $("#untaxed_amount_wrapper").removeClass("hidden");

    $("#tax_amount_skeleton").addClass("hidden");
    $("#tax_amount_wrapper").removeClass("hidden");

    $("#total_amount_skeleton").addClass("hidden");
    $("#total_amount_wrapper").removeClass("hidden");
};

// Fetch data sales order
detailSO = () => {
    skeleton();

    $.ajax({
        url: `/sales/detail/${id}/data`,
        method: "GET",
        dataType: "json",
        success: function (data) {
            unSkeleton();

            informationPopulate(data);
            subInformationPopulate(data);

            if (
                data.sales_order.status == "confirmed" ||
                data.sales_order.status == "canceled"
            ) {
                confirmBtn.prop("disabled", true);
                cancelBtn.prop("disabled", true);
                lockBtn.prop("disabled", true);
                deleteBtn.prop("disabled", true);
            } else if (data.sales_order.status == "locked") {
                confirmBtn.prop("disabled", false);
                cancelBtn.prop("disabled", false);
                lockBtn.prop("disabled", true);
                deleteBtn.prop("disabled", true);
            } else {
                confirmBtn.prop("disabled", false);
                cancelBtn.prop("disabled", false);
                lockBtn.prop("disabled", false);
                deleteBtn.prop("disabled", false);
            }
        },
        error: function (xhr, status, error) {
            console.error("Gagal ambil detail sales order:", error);
        },
    });
};

// Datatable
dtColumns = [
    {
        data: null,
        name: "rownum",
        orderable: false,
        searchable: false,
        render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        },
    },
    { data: "products.name", name: "products.name" },
    { data: "products.name", name: "products.name" },
    { data: "quantity", name: "quantity", searchable: false },
    { data: "quantity", name: "quantity", searchable: false },
    { data: "quantity", name: "quantity", searchable: false },
    {
        data: "products.unit.name",
        name: "products.unit.name",
        searchable: false,
    },
    { data: "products.type", name: "products.type" },
    {
        data: "products.sales_price",
        name: "products.sales_price",
        searchable: false,
    },
    {
        data: "taxes.name",
        name: "taxes.name",
        render: function (data, type, row, meta) {
            return `<div class="badge badge-ghost text-xs">${data}</div>`;
        },
    },
    {
        data: "discount",
        name: "discount",
        searchable: false,
        render: function (data, type, row, meta) {
            return data + " %";
        },
    },
    {
        data: "subtotal",
        name: "subtotal",
        searchable: false,
        render: function (data) {
            return data ? rupiahFormatter.init(data) : "-";
        },
    },
];
dtUrl = `/sales/detail/${id}/datatable`;
dtId = "#sales-order-detail-table";

// Update status sales order
updateStatusSalesOrder = () => {
    const actions = [
        { buttonId: "#confirm_btn", endpoint: "confirm" },
        { buttonId: "#cancel_btn", endpoint: "cancel" },
        { buttonId: "#lock_btn", endpoint: "lock" },
    ];

    actions.forEach((action) => {
        $(action.buttonId).on("click", function () {
            $.ajax({
                url: `/sales/detail/${id}/${action.endpoint}`,
                method: "GET",
                dataType: "json",
                success: function (response) {
                    notyf.success(response.message);
                    setTimeout(() => location.reload(), 1000);
                },
                error: function (xhr, status, error) {
                    console.error(
                        `Failed to ${action.endpoint} sales order:`,
                        error
                    );
                    notyf.error(`Failed to ${action.endpoint} sales order`);
                },
            });
        });
    });
};

// Print sales order
printSalesOrder = () => {
    $(printBtn).on("click", function () {
        const printWindow = window.open(`/sales/detail/${id}/print`, "_blank");
        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
        };
    });
};

// Export sales order
exportSalesOrder = () => {
    $("#export_pdf_btn, #export_excel_btn").on("click", function (e) {
        e.preventDefault();

        const type = $(this).data("type");
        window.location.href = `/sales/detail/${id}/export?type=${type}`;
    });
};

document.addEventListener("DOMContentLoaded", function () {
    detailSO();
    updateStatusSalesOrder();
    printSalesOrder();
    exportSalesOrder();
    DataTable.init(dtColumns, dtUrl, dtId);
});
