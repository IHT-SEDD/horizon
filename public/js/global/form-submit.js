$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function handleAjaxSubmit(formElement, url) {
    const data = formElement.serialize();

    $.ajax({
        url: url,
        method: "POST",
        data: data,
        dataType: "json",
        beforeSend: function () {
            formElement
                .find("button[type=submit]")
                .prop("disabled", true)
                .text("Submitting...");
        },
        success: function (response) {
            notyf.success(response.message);

            formElement.trigger("reset");

            formElement.find(".tom-select").each(function () {
                const tomSelectInstance = this.tomselect;
                if (tomSelectInstance) {
                    tomSelectInstance.clear();
                    tomSelectInstance.clearOptions();
                }
            });

            if (typeof reloadDataTable === "function") reloadDataTable();
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
        },
        complete: function () {
            formElement
                .find("button[type=submit]")
                .prop("disabled", false)
                .text("Submit");
        },
    });
}
