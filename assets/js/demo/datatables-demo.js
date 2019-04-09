// Call the dataTables jQuery plugin
$(document).ready(function () {
  let pagingType = screen.width < 767 ? "full" : "simple_numbers";
  let datatable = $('#dataTable').DataTable({
    // "lengthChange": false
    // "dom": "rtip",
    "dom":
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    "pageLength": 5,
    "pagingType": pagingType,
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
    },
    "columnDefs":[{
      "targets": 'no-sort',
      "orderable": false
    }]
  });
  try {
    document.querySelector('#searchField').addEventListener('keyup', (event) => {
      datatable.search(event.target.value).draw();
    });
  } catch (error) {
    // if element exists in this page
  }
});
