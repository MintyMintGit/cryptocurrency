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
    $(".pointer").on('click', function (event) {
        dataCurrency = $(event.currentTarget).attr('data-currency');
        coefficient = currencyExchangeRatesSecond.attr('data-usd' + dataCurrency);
        var switchButton = $("#currency-switch-button");

        switchButton.text(dataCurrency.toUpperCase() + " ");
        switchButton.append("<span class=\"caret\"></span>");

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
                element.innerHTML = mapShortCodetoSymbol(dataCurrency) + (parseFloat(costInDollars) * coefficient).toFixed(2);
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
        event.preventDefault();
    });
});