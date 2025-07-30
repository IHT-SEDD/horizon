const DataTable = (function () {
    let table;

    // Debounce utility for searching
    function debounce(func, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Datatable initiation
    function initDatatable(dtColumns, dtUrl, dtId, dtWith = []) {
        table = $(dtId).DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            ajax: {
                url: dtUrl,
                data: function (d) {
                    d.with = dtWith;
                    d.search_custom = $("#search-dt").val();
                },
            },
            columns: dtColumns,
            dom: '<"flex flex-wrap gap-2 justify-between items-center w-full mt-6">rt<"flex flex-wrap gap-2 justify-between items-center text-sm w-full mt-6"ip>',
            drawCallback: function () {
                if (window.lucide) {
                    lucide.createIcons();
                }
            },
        });

        const filterSearch = document.querySelector(
            '[data-kt-docs-table-filter="search"]'
        );
        if (filterSearch) {
            filterSearch.addEventListener(
                "input",
                debounce(function (e) {
                    table.search(e.target.value).draw();
                }, 600)
            );
        }

        $(document).on("click", ".btn-action-dropdown", function (e) {
            e.stopPropagation();

            let $dropdown = $(this)
                .closest(".action-dropdown")
                .find(".dropdown-content");
            console.log($dropdown);

            $dropdown
                .css({
                    display: "fixed",
                    "z-index": "9999",
                })
                .show();
        });
    }

    return {
        init: initDatatable,
    };
})();

function reloadDataTable(dtId) {
    $(dtId).DataTable().ajax.reload(null, false);
}
