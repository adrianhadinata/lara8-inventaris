let table;

table = $("#dataTable").DataTable({
    dom: "Bfrtip",
    buttons: ["copy", "csv", "excel", "pdf", "print"],
    responsive: true,
    scrollX: true,
    rowReorder: {
        selector: "td:nth-child(2)",
    },
});
