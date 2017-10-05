var currencyExchangeRates = $("#currency-exchange-rates");
function getExchangeRates() {
    $.ajax({
        url: $("#ExchangeRatesLink").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for (let i = 0; i < data['data'].length; i++) {
                currencyExchangeRates.attr('data-' + data['data'][i].name_quotes, data['data'][i].value_quotes);
            }

        }
    });
}

$(document).ready(function () {
    getExchangeRates();
});