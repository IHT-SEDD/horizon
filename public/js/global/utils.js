const rupiahFormatter = (function () {
    function initRupiahFormatter(data) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        }).format(data);
    }

    function formatOnInput(inputElement = "#input_price") {
        const el =
            typeof inputElement === "string"
                ? document.querySelector(inputElement)
                : inputElement;

        if (!el) return;

        el.addEventListener("input", function () {
            const raw = this.value.replace(/[^\d]/g, "");
            const numeric = parseInt(raw || "0", 10);
            this.dataset.raw = numeric;
            this.value = initRupiahFormatter(numeric);
        });
    }

    function resetToNumeric(inputElement = "#input_price") {
        const el =
            typeof inputElement === "string"
                ? document.querySelector(inputElement)
                : inputElement;

        if (!el) return;

        const raw = el.dataset.raw || el.value.replace(/[^\d]/g, "");
        el.value = raw;
    }

    return {
        init: initRupiahFormatter,
        enableInputFormat: formatOnInput,
        resetToNumeric: resetToNumeric,
    };
})();
