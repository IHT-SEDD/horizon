let validationMessages, validator, dtColumns, dtUrl, dtId, dtWith;

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
    { data: "brand", name: "brand", searchable: false },
    { data: "type", name: "type", searchable: false },
    {
        data: "category.name",
        name: "category.name",
        searchable: false,
    },
    { data: "unit.name", name: "unit.name", searchable: false },
    {
        data: "sales_price",
        name: "sales_price",
        searchable: false,
        render: function (data) {
            return data ? rupiahFormatter.init(data) : "-";
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
dtUrl = "/master/product/datatable";
dtId = "#master-table";
dtWith = ["category", "unit"];

validator = {
    name: {
        required: true,
        minlength: 5,
    },
    brand: {
        required: true,
        minlength: 5,
    },
    type: {
        required: true,
        minlength: 3,
    },
    product_unit_id: {
        required: true,
    },
    product_category_id: {
        required: true,
    },
    price: {
        required: true,
        number: true,
    },
};

validationMessages = {
    name: {
        required: "Name is required",
        minlength: "Name must be at least 5 characters",
    },
    brand: {
        required: "Brand is required",
        minlength: "Brand must be at least 5 characters",
    },
    type: {
        required: "Type is required",
        minlength: "Type must be at least 3 characters",
    },
    product_unit_id: {
        required: "Product unit is required",
    },
    product_category_id: {
        required: "Product category is required",
    },
    price: {
        required: "Price is required",
        number: "Price must be a valid number",
    },
};

document.addEventListener("DOMContentLoaded", function () {
    FormValidator.init(
        "#master-form",
        validator,
        validationMessages,
        function (formElement) {
            rupiahFormatter.resetToNumeric();
            handleAjaxSubmit(formElement, "/master/product/add");
        }
    );
    TomSelectConfig.init(
        "/master/product-category/select",
        "#select-one-category",
        "Choose product category..."
    );
    TomSelectConfig.init(
        "/master/product-unit/select",
        "#select-one-unit",
        "Choose product unit..."
    );
    DataTable.init(dtColumns, dtUrl, dtId, dtWith);
    rupiahFormatter.enableInputFormat();
});
