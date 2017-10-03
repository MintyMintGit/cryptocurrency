$(document).ready(function () {
    var viewAll = $("#ViewAll");

    var table = $('#marketCapitalizations')
        .on('xhr.dt', function (e, settings, json, xhr) {
            if(typeof json.links != 'undefined') {
                if(json.links.next != null) {
                    $("#nextLink").show();
                    $("#nextLink").attr('href', json.links.next);
                } else {
                    $("#nextLink").hide();
                }
                if(json.links.prev != null) {
                    $("#previousLink").show();
                    $("#previousLink").attr('href', json.links.prev);
                } else {
                    $("#previousLink").hide();
                }

            }
        })
        .dataTable({
            "pageLength": 100,
            "ajax": $("#GlobalDataLink").val(),
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
    $("#nextLink").on('click', function (event) {
        event.preventDefault();
        table.DataTable().destroy();
        table.dataTable({
            "ajax": $("#nextLink").attr('href'),
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
    $("#previousLink").on('click', function (event) {
        event.preventDefault();
        table.DataTable().destroy();
        table.dataTable({
            "ajax": $("#previousLink").attr('href'),
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

    getExchangeRates();
});
function getExchangeRates() {


    $.ajax({
        url: $("#ExchangeRatesLink").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for(let i=0; i<data['data'].length; i++) {
                data['data'][i].name_quotes;
                data['data'][i].value_quotes;
            }

        }
    });
}

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