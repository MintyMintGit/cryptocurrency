$(document).ready(function () {
    var table = $("#allCrypto").dataTable({
        "paging": false,
        "columns": [
            null,
            null,
            null,
            {"className": "market_cap_usd"},
            {"className": "price"},
            {"className": "supply"},
            {"className": "volume"},
            null,
            null,
            null
        ]
    });
    $('#search_filter_input').keyup(function(){
        table.DataTable().search($(this).val()).draw() ;
    });

    сurrencySwitcher(table);
});