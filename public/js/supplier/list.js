let table;

table = $("#dataTable").DataTable({
    responsive: true,
    scrollX: true,
    rowReorder: {
        selector: "td:nth-child(2)",
    },
    autoWidth: true,
});
