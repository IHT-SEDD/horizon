let dtColumns, dtUrl, dtId, dtColumnActionIndex;

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
    { data: "quotation_number", name: "quotation_number" },
    { data: "customers.name", name: "customers.name" },
    { data: "payment_terms.name", name: "payment_terms.name" },
    {
        data: "sales_products",
        name: "sales_products",
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
            if (!Array.isArray(data) || data.length === 0) return "-";
            const productNames = data.map((item) => item.products?.name || "-");
            return productNames.join(", ");
        },
    },
    {
        data: "untaxed_amount",
        name: "untaxed_amount",
        searchable: false,
        render: function (data) {
            return data ? rupiahFormatter.init(data) : "-";
        },
    },
    {
        data: "tax_amount",
        name: "tax_amount",
        searchable: false,
        render: function (data) {
            return data ? rupiahFormatter.init(data) : "-";
        },
    },
    {
        data: "grand_total",
        name: "grand_total",
        searchable: false,
        render: function (data) {
            return data ? rupiahFormatter.init(data) : "-";
        },
    },
    {
        data: "status",
        name: "status",
        render: function (data, type, row, meta) {
            if (data == "confirmed") {
                return `<div class="badge badge-success text-xs">Confirmed</div>`;
            } else if (data == "canceled") {
                return `<div class="badge badge-error text-xs">Canceled</div>`;
            } else if (data == "locked") {
                return `<div class="badge badge-warning text-xs">Locked</div>`;
            } else {
                return `<div class="badge badge-ghost text-xs">Quotation</div>`;
            }
        },
    },
    { data: "users.name", name: "users.name" },
    {
        data: "created_at",
        name: "created_at",
        render: function (data, type, row) {
            if (!data) return "-";
            return dayjs(data).format("DD MMM YYYY, HH:mm");
        },
    },
    {
        data: null,
        name: "action",
        orderable: false,
        searchable: false,
        render: function (data, type, row, meta) {
            return `<div class="dropdown dropdown-bottom dropdown-end action-dropdown">
                <div tabindex="0" role="button" class="btn btn-sm btn-outline m-1 btn-action-dropdown">
                    <i data-lucide="ellipsis" width="13" height="13"></i>
                </div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box w-48 p-2 shadow z-[999]">
                    <li>
                        <a href="/sales/detail/${row.id}" class="flex justify-start items-center gap-3 text-info">
                            <i data-lucide="circle-ellipsis" width="13" height="13"></i> Detail
                        </a>
                    </li>
                    <li class="border-t border-dashed border-base-200">
                        <a class="flex justify-start items-center gap-3 text-error">
                            <i data-lucide="trash" width="13" height="13"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>`;
        },
    },
];
dtUrl = "/sales/datatable";
dtId = "#sales-order-table";
dtWith = ["customers", "paymentTerms", "users", "salesProducts"];

document.addEventListener("DOMContentLoaded", function () {
    DataTable.init(dtColumns, dtUrl, dtId, dtWith);
});
