$(document).ready(function () {
    var table = $("#allCrypto").dataTable({
        "paging": false
    });
    $('#search_filter_input').keyup(function(){
        table.DataTable().search($(this).val()).draw() ;
    });
});