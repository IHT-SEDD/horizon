const DateRangePicker = (function () {
    function initDrp({ selector, onChange, single = true, range = false }) {
        const isSingle = single === true && range === false;

        $(selector).daterangepicker(
            isSingle
                ? {
                      singleDatePicker: true,
                      showDropdowns: true,
                      autoUpdateInput: true,
                      locale: {
                          format: "YYYY/MM/DD",
                      },
                      startDate: moment(),
                  }
                : {
                      showButtonPanel: true,
                      startDate: moment(),
                      endDate: moment(),
                      ranges: {
                          Today: [moment(), moment()],
                          Yesterday: [
                              moment().subtract(1, "days"),
                              moment().subtract(1, "days"),
                          ],
                          "Last 7 Days": [
                              moment().subtract(6, "days"),
                              moment(),
                          ],
                          "Last 30 Days": [
                              moment().subtract(29, "days"),
                              moment(),
                          ],
                          "This Month": [
                              moment().startOf("month"),
                              moment().endOf("month"),
                          ],
                          "Last Month": [
                              moment().subtract(1, "month").startOf("month"),
                              moment().subtract(1, "month").endOf("month"),
                          ],
                      },
                      locale: {
                          format: "YYYY/MM/DD",
                      },
                  }
        );

        $(selector).on("change", function () {
            const drp = $(this).data("daterangepicker");
            const start = drp.startDate.format("YYYY-MM-DD");
            const end = drp.singleDatePicker
                ? start
                : drp.endDate.format("YYYY-MM-DD");
            onChange(start, end);
        });
    }

    return {
        init: initDrp,
    };
})();
