const FormValidator = (function () {
    function initValidation(
        formSelector,
        rules = {},
        messages = {},
        onSubmit = null
    ) {
        const form = $(formSelector);
        if (!form.length) return;

        form.validate({
            rules: rules,
            messages: messages,
            errorElement: "span",
            errorClass: "text-red-500 text-sm mt-1 block",
            highlight: function (element) {
                const $el = $(element);
                const tag = element.tagName.toLowerCase();
                const type = $el.attr("type");

                if (tag === "textarea") {
                    $el.addClass("textarea-error");
                } else if (tag === "select") {
                    $el.addClass("select-error");
                } else if (type === "radio") {
                    $el.addClass("radio-error");
                } else if (type === "checkbox") {
                    $el.addClass("checkbox-error");
                } else if (type === "file") {
                    $el.addClass("file-input-error");
                } else if ($el.hasClass("toggle")) {
                    $el.addClass("toggle-error");
                } else {
                    $el.addClass("input-error");
                }
            },
            unhighlight: function (element) {
                const $el = $(element);
                const tag = element.tagName.toLowerCase();
                const type = $el.attr("type");

                if (tag === "textarea") {
                    $el.removeClass("textarea-error");
                } else if (tag === "select") {
                    $el.removeClass("select-error");
                } else if (type === "radio") {
                    $el.removeClass("radio-error");
                } else if (type === "checkbox") {
                    $el.removeClass("checkbox-error");
                } else if (type === "file") {
                    $el.removeClass("file-input-error");
                } else if ($el.hasClass("toggle")) {
                    $el.removeClass("toggle-error");
                } else {
                    $el.removeClass("input-error");
                }
            },
            submitHandler: function (form, event) {
                event.preventDefault();
                if (typeof onSubmit === "function") {
                    onSubmit($(form));
                }
            },
        });
    }

    return {
        init: initValidation,
    };
})();
