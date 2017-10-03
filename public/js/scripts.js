$(document).ready(function () {
    var viewAll = $("#ViewAll");

    var table = $('#marketCapitalizations')
        .on('xhr.dt', function (e, settings, json, xhr) {

            var a = 10;
        })
        .dataTable({
            "pageLength": 100,
            "ajax": "http://cryptocurrency.local/api/GlobalDataApi",
            "columns": [
                {"data": "rank"},
                {"data": "name"},
                {"data": "market_cap_usd"},
                {"data": "price_usd"},
                {"data": "total_supply"},
                {"data": "volume_usd_24h"},
                {"data": "percent_change_24h"},
                {"data": ""}
            ],
            "destroy": "true"
        });
    viewAll.on('click', function (event) {
        event.preventDefault();
        //table.fnClearTable();
        table.DataTable().destroy();
        table.dataTable({
            "ajax": $("#viewAllLink").val(),
            "paging": false,
            "columns": [
                {"data": "rank"},
                {"data": "name"},
                {"data": "market_cap_usd"},
                {"data": "price_usd"},
                {"data": "total_supply"},
                {"data": "volume_usd_24h"},
                {"data": "percent_change_24h"},
                {"data": ""}
            ]
        });
    });

});

// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
// 'ajax': {
//     'url': url,
//         'type': 'GET',
//         'beforeSend': function (request) {
//         request.setRequestHeader("token", token);
//     }
// }