const notyf = new Notyf({
    duration: 1000,
    position: {
        x: "right",
        y: "top",
    },
    types: [
        {
            type: "warning",
            background: "#ffbe00",
            icon: {
                className: "material-icons",
                tagName: "i",
                text: "warning",
            },
        },
        {
            type: "error",
            background: "#ff5861",
            duration: 2000,
            dismissible: true,
        },
        {
            type: "success",
            background: "#00a96e",
            duration: 2000,
            dismissible: true,
        },
    ],
});
