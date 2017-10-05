var currencyExchangeRates = $("#currency-exchange-rates");
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
        {"data": "rank"},
        {"data": "name"},
        {"data": "market_cap_usd", "className": "market_cap_usd"},
        {"data": "price_usd", "className": "price"},
        {"data": "total_supply", "className": "total_supply"},
        {"data": "volume_usd_24h", "className": "volume"},
        {"data": "percent_change_24h"},
        {"data": ""}
    ],
    "aoColumnDefs": [{
        "aTargets": [1, 2, 3, 4, 5, 6],
        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            $(nTd).attr('data-usd', sData);
            switch (iCol) {
                case 1:
                    var linkCrypto = sData.toLowerCase();
                    linkCrypto = linkCrypto.split(" ").join("-");
                    var icon = "<div class=\"s-s-" + linkCrypto + " currency-logo-sprite\"></div>";
                    nTd.innerHTML = icon + '<a href="crypto/' + linkCrypto + '">' + nTd.innerHTML + '</a>';
                    break;
                case 2:
                    nTd.innerHTML = '$' + makeBeautyMoney(sData);
                    break;
                case 3:
                    nTd.innerHTML = '$' + sData;
                    break;
                case 4:
                    nTd.innerHTML = makeBeautyMoney(sData) + " " + oData.symbol;
                    break;
                case 5:
                    nTd.innerHTML = '$' + makeBeautyMoney(sData);
                    break;
                case 6:
                    var temp = "<span class='"
                    temp += sData >= 0 ? "makeItGreen" : "makeItRed";
                    temp += "'>" + sData + "%</span>";
                    nTd.innerHTML = temp;
                    break;
            }
        }
    }]

};

$(document).ready(function () {
    getExchangeRates();
    var viewAll = $("#ViewAll");
    $("#navigation li").removeClass('active');
    $("#homeTab").addClass("active");
    var table = $('#marketCapitalizations');
    configDataTable.ajax = $("#GlobalDataLink").val();
    table.on('xhr.dt', function (e, settings, json, xhr) {
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
    viewAll.on('click', function (event) {
        event.preventDefault();
        table.DataTable().destroy();
        configDataTable.ajax = $("#viewAllLink").val();
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


    $(".pointer").on('click', function (event) {
        dataCurrency = $(event.currentTarget).find('a').attr('data-currency');
        coefficient = currencyExchangeRates.attr('data-usd' + dataCurrency);
        $("#currency-switch-button").text(dataCurrency.toUpperCase());
        //market_cap_usd

        table.find('tbody tr .market_cap_usd').each(function (indx, element) {
            if (dataCurrency == "btc") {
                element.innerHTML = parseInt(parseFloat(element.getAttribute('data-usd')) / parseFloat($("#bitcoinPrice").val())) + " BTC";
            } else if (dataCurrency == "eth") {
                element.innerHTML = parseInt(parseFloat(element.getAttribute('data-usd')) / parseFloat($("#ethPrice").val())) + " ETH";
            } else {
                var costInDollars = $(element).attr('data-usd');
                element.innerHTML = mapShortCodetoSymbol(dataCurrency) + makeBeautyMoney(parseFloat(costInDollars) * coefficient);
            }
        });

        //price
        table.find('tbody tr .price').each(function (indx, element) {
            if (dataCurrency == "btc") {
                element.innerHTML = (parseFloat(element.getAttribute('data-usd')) / parseFloat($("#bitcoinPrice").val())).toFixed(8) + " BTC";
            } else if (dataCurrency == "eth") {
                element.innerHTML = (parseFloat(element.getAttribute('data-usd')) / parseFloat($("#ethPrice").val())).toFixed(8) + " ETH";
            } else {
                var costInDollars = $(element).attr('data-usd');
                element.innerHTML = mapShortCodetoSymbol(dataCurrency) + parseFloat(costInDollars) * coefficient;
            }
        });

        //Volume
        table.find('tbody tr .volume').each(function (indx, element) {
            if (dataCurrency == "btc") {
                element.innerHTML = (parseFloat(element.getAttribute('data-usd')) / parseFloat($("#bitcoinPrice").val())).toFixed(3) + " BTC";
            } else if (dataCurrency == "eth") {
                element.innerHTML = (parseFloat(element.getAttribute('data-usd')) / parseFloat($("#ethPrice").val())).toFixed(3) + " ETH";
            } else {
                var costInDollars = $(element).attr('data-usd');
                element.innerHTML = mapShortCodetoSymbol(dataCurrency) + makeBeautyMoney(parseFloat(costInDollars) * coefficient);
            }
        });
    });
});

function mapShortCodetoSymbol(shortCode) {
    shortCode = shortCode.toLowerCase();
    return currency_symbols[shortCode];
}

function makeBeautyMoney(someMoney) {
    return someMoney.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
}
function getExchangeRates(callback) {
    $.ajax({
        url: $("#ExchangeRatesLink").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for (let i = 0; i < data['data'].length; i++) {
                currencyExchangeRates.attr('data-' + data['data'][i].name_quotes, data['data'][i].value_quotes);
            }
            if(i == data['data'].length && callback) {
                callback();
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