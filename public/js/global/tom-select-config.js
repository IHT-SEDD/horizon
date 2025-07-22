const TomSelectConfig = (function () {
    function initTomselect(selectUrl, selector, selectPlaceholder) {
        $.ajax({
            url: selectUrl,
            method: "GET",
            dataType: "json",
            success: function (response) {
                const options = response.map(function (item) {
                    return {
                        value: item.id,
                        text: item.name,
                    };
                });

                new TomSelect(selector, {
                    options: options,
                    create: false,
                    maxItems: 1,
                    placeholder: selectPlaceholder,
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
