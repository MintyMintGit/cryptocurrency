var currencyExchangeRates = [];

function getExchangeRates() {
    $.ajax({
        url: $("#ExchangeRatesLink").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for (let i = 0; i < data['data'].length; i++) {
                var name = data['data'][i].name_quotes.substring(3);
                currencyExchangeRates.push(name);
            }
        }
    });
}

$(document).ready(function () {
    $("#navigation li").removeClass('active');
    $("#calculatorTab").addClass("active");
    getExchangeRates();

    $("#from").on('keyup', function (event) {
        $("#autoFrom li").remove();
        var key = event.currentTarget.value.toUpperCase();
        var hardcoded = $("#hardcoded li").clone();
        $("#autoFrom").append(hardcoded);
        $.each(currencyExchangeRates, function (indx, element) {
            if(currencyExchangeRates[indx].substring(0, key.length) == key) {
                $("#autoFrom").append("<li>" + currencyExchangeRates[indx] + "</li>")
            }
        });
    });

    $("#to").on('keyup', function (event) {
        $("#autoTo li").remove();
        var key = event.currentTarget.value.toUpperCase();
        var hardcoded = $("#hardcoded li").clone();
        $("#autoTo").append(hardcoded);
        $.each(currencyExchangeRates, function (indx, element) {
            if(currencyExchangeRates[indx].substring(0, key.length) == key) {
                $("#autoTo").append("<li>" + currencyExchangeRates[indx] + "</li>")
            }
        });
    });

});