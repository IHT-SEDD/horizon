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
            dom: '<"flex justify-between items-center mb-4">rt<"flex justify-between items-center mt-4 text-sm"ip>',
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
    }

    return {
        init: initDatatable,
    };
})();

function reloadDataTable() {
    $("#master-table").DataTable().ajax.reload(null, false);
}
