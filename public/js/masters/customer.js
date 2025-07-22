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
    { data: "contact", name: "contact", searchable: false },
    { data: "phone_mobile", name: "phone_mobile", searchable: false },
    { data: "email", name: "email", searchable: false },
    { data: "address", name: "address", searchable: false },
    {
        data: null,
        name: "reffered_to",
        searchable: false,
        render: function (data, type, row) {
            return row.referred_to_role + " - " + row.referred_to_name;
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
dtUrl = "/master/customer/datatable";
dtId = "#master-table";

validator = {
    name: {
        required: true,
        minlength: 5,
    },
    contact: {
        required: false,
        number: true,
        minlength: 8,
    },
    phone_mobile: {
        required: false,
        number: true,
        minlength: 8,
    },
    email: {
        required: true,
        email: true,
    },
    address: {
        required: true,
        minlength: 5,
    },
    referred_to_name: {
        required: true,
        minlength: 5,
    },
    referred_to_role: {
        required: true,
        minlength: 5,
    },
};

validationMessages = {
    name: {
        required: "Name is required",
        minlength: "Name must be at least 5 characters",
    },
    contact: {
        minlength: "Contact must be at least 8 characters",
        number: "Contact must be a number",
    },
    phone_mobile: {
        minlength: "Mobile phone must be at least 8 characters",
        number: "Mobile phone must be a number",
    },
    email: {
        required: "Email is required",
        email: "Enter a valid email",
    },
    address: {
        required: "Address is required",
        minlength: "Address must be at least 5 characters",
    },
    referred_to_name: {
        required: "Name referrer is required",
        minlength: "Name referrer must be at least 5 characters",
    },
    referred_to_role: {
        required: "Name referrer is required",
        minlength: "Name referrer must be at least 5 characters",
    },
};

document.addEventListener("DOMContentLoaded", function () {
    FormValidator.init(
        "#master-form",
        validator,
        validationMessages,
        function (formElement) {
            handleAjaxSubmit(formElement, "/master/customer/add");
        }
    );
    DataTable.init(dtColumns, dtUrl, dtId);
});
