var currencyExchangeRates = [];
var searchListItems = "";
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

    $("#to, #from").on('keyup', function (event) {
        var currentItem = $(event.currentTarget);
        searchListItems = currentItem.siblings('ul');
        searchListItems.html('');
        var key = event.currentTarget.value.toUpperCase();
        var hardcoded = $("#hardcoded li").clone();
        searchListItems.append(hardcoded);
        $.each(currencyExchangeRates, function (indx, element) {
            if(currencyExchangeRates[indx].substring(0, key.length) == key) {
                searchListItems.append("<li>" + currencyExchangeRates[indx] + "</li>")
            }
        });
    });
});