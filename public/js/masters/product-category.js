let validationMessages, validator, dtColumns, dtUrl, dtId;

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
    { data: "name", name: "name" },
    {
        data: "is_active",
        name: "is_active",
        render: function (data, type, row, meta) {
            const activeIcon = `<i data-lucide="check" width="14" height="14"></i>`;
            const notActiveIcon = `<i data-lucide="cross" width="14" height="14"></i>`;
            if (data == 1) {
                return `<div class="badge badge-success gap-2 text-xs text-base-100">${activeIcon} Active</div>`;
            } else {
                return `<div class="badge badge-warning gap-2 text-xs text-base-100">${notActiveIcon} Not Active</div>`;
            }
        },
    },
    {
        data: "created_at",
        name: "created_at",
        render: function (data, type, row) {
            if (!data) return "-";
            return dayjs(data).format("DD MMM YYYY, HH:mm");
        },
    },
];
dtUrl = "/master/product-category/datatable";
dtId = "#master-table";

validator = {
    name: {
        required: true,
        minlength: 3,
    },
    is_active: {
        required: true,
    },
};

validationMessages = {
    name: {
        required: "Name is required",
        minlength: "Name must be at least 3 characters",
    },
    is_active: {
        required: "Active status is required",
    },
};

document.addEventListener("DOMContentLoaded", function () {
    FormValidator.init(
        "#master-form",
        validator,
        validationMessages,
        function (formElement) {
            handleAjaxSubmit(formElement, "/master/product-category/add");
        }
    );
    DataTable.init(dtColumns, dtUrl, dtId);
});
