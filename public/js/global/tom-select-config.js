const TomSelectConfig = (function () {
    function initTomselect({
        url,
        selector,
        placeholder = "",
        onChange = null,
    }) {
        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success: function (response) {
                const options = response.map((item) => {
                    const base = {
                        value: item.id,
                        text: item.name,
                    };

                    // Inject extra field if it's tax select
                    if (url === "/master/tax/select") {
                        base.nominal = item.value; // custom data (bukan data-attribute)
                    }

                    return base;
                });

                new TomSelect(selector, {
                    options,
                    create: false,
                    maxItems: 1,
                    placeholder,
                    onChange: function (value) {
                        if (typeof onChange === "function") {
                            const selected = this.options[value];
                            onChange(value, selected);
                        }
                    },
                });
            },
            error: function (xhr, status, error) {
                console.error("Gagal mengambil data kategori:", error);
            },
        });
    }

    return {
        init: initTomselect,
    };
})();
