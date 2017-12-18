var currencyExchangeRatesSecond = $("#currency-exchange-rates");
let currency_symbols = {
    "aud": "$",
    "brl": "R$",
    "cad": "$",
    "chf": "Fr. ",
    "clp": "$",
    "cny": "¥",
    "czk": "K",
    "dkk": "kr. ",
    "eur": "€",
    "gbp": "£",
    "hkd": "$",
    "huf": "Ft ",
    "idr": "Rp ",
    "ils": "₪",
    "inr": "₹",
    "jpy": "¥",
    "krw": "₩",
    "mxn": "$",
    "myr": "RM",
    "nok": "kr ",
    "nzd": "$",
    "php": "₱",
    "pkr": "₨ ",
    "pln": "zł",
    "rub": "₽",
    "sek": "kr ",
    "sgd": "S$",
    "thb": "฿",
    "try": "₺",
    "twd": "NT$",
    "usd": "$",
    "zar": "R ",
};
var dataCurrency = 0;
var coefficient = 0;
var configDataTable = {
    "ajax": $("#viewAllLink").val(),
    "paging": false,
    "columns": [
        {"data": null, "className": "num"},
        {"data": "name", "className": "name"},
        {"data": "market_cap_usd", "className": "marketcup"},
        {"data": "price_usd", "className": "price"},
        {"data": "total_supply", "className": "supply"},
        {"data": "volume_usd_24h", "className": "volume"},
        {"data": "percent_change_24h", "className": "change"},
        {"data": null, "className": "graph"}
    ],
    "order": [[ 0, 'asc' ]],
    "aoColumnDefs": [{
        "aTargets": [1, 2, 3, 4, 5, 6, 7],
        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            $(nTd).attr('data-usd', sData);
            switch (iCol) {
                case 1:
                    var linkCrypto = oData.id.toLowerCase();
                    linkCrypto = linkCrypto.split(" ").join("-");
                    var icon = "<div class=\"s-s-" + linkCrypto + " currency-logo-sprite\"></div>";
                    nTd.innerHTML = icon + '<a href="crypto/' + linkCrypto + '">' + nTd.innerHTML + '</a>';
                    break;
                case 2:
                    nTd.innerHTML = '$' + makeBeautyMoney(sData);
                    break;
                case 3:
                    nTd.innerHTML = '$' + limitToSix(sData);
                    break;
                case 4:
                    nTd.innerHTML = makeBeautyMoney(sData) + " " + oData.symbol;
                    break;
                case 5:
                    nTd.innerHTML = '$' + makeBeautyMoney(sData);
                    break;
                case 6:
                    var temp = "<span class='"
                    temp += sData >= 0 ? "green" : "red";
                    temp += "'>" + limitToTwo(sData) + "%</span>";
                    nTd.innerHTML = temp;
                    break;
                case 7:
                    var linkCrypto = oData.id.toLowerCase();
                    linkCrypto = linkCrypto.split(" ").join("-");
                    var graph = "<img src='/img/crypto/" + linkCrypto  +".png'>";
                    nTd.innerHTML = '<a href="crypto/' + linkCrypto + '">' + graph + '</a>';
                    break;
            }
        }

    }]
};

$(document).ready(function () {
    //$(".converter").hide();
    getExchangeRatesGlobal();
    var viewAll = $("#ViewAll");
    $(".tab1").on('click', function (event) {
        $(".tab1").hide();
        $(".tab2").show();
    });

    $(".tab2").on('click', function (event) {
        $(".tab2").hide();
        $(".tab1").show();
    });

    var table = $('#marketCapitalizations');
    configDataTable.ajax = $("#GlobalDataLink").val();
    var indexCell = 1;
    table.on('xhr.dt', function (e, settings, json, xhr) {
        if(typeof json.meta !== 'undefined') {
            indexCell = json.meta.from;
        }

        if (typeof json.links != 'undefined') {
            if (json.links.next != null) {
                $("#nextLink").show();
                $("#nextLink").attr('href', json.links.next);
            } else {
                $("#nextLink").hide();
            }
            if (json.links.prev != null) {
                $("#previousLink").show();
                $("#previousLink").attr('href', json.links.prev);
            } else {
                $("#previousLink").hide();
            }
        }
    }).dataTable(configDataTable);

    table.DataTable().on( 'order.dt search.dt', function () {
        table.DataTable().column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i + indexCell;
        } );
    } ).draw();

    $('#search_filter_input').keyup(function(){
        table.DataTable().search($(this).val()).draw() ;
    });

    viewAll.on('click', function (event) {
        indexCell = 1;
        event.preventDefault();
        table.DataTable().destroy();
        configDataTable.ajax = {"url":$("#viewAllLink").val(),"dataSrc":""}
        // configDataTable.ajax = $("#viewAllLink").val();
        table.dataTable(configDataTable);

    });
    $("#nextLink").on('click', function (event) {
        event.preventDefault();
        table.DataTable().destroy();
        configDataTable.ajax = $("#nextLink").attr('href');
        table.dataTable(configDataTable);
    });
    $("#previousLink").on('click', function (event) {
        event.preventDefault();
        table.DataTable().destroy();
        configDataTable.ajax = $("#previousLink").attr('href');
        table.dataTable(configDataTable);
    });

    сurrencySwitcher(table);
});

function mapShortCodetoSymbol(shortCode) {
    shortCode = shortCode.toLowerCase();
    return currency_symbols[shortCode];
}
function limitToSix(someMoney) {
    return parseFloat(someMoney).toFixed(6);
}
function limitToTwo(someMoney) {
    return parseFloat(someMoney).toFixed(2);
}
function makeBeautyMoney(someMoney) {
    return parseFloat(someMoney).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}
function getExchangeRatesGlobal(callback) {
    $.ajax({
        url: $("#ExchangeRatesLink").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for (let i = 0; i < data['data'].length; i++) {
                currencyExchangeRatesSecond.attr('data-' + data['data'][i].name_quotes, data['data'][i].value_quotes);
            }
        }
    });
}