var currencyExchangeRates = [];
var searchListItems = $("#autoFrom li, #autoTo li");
var hardcoded = ['USD', 'EUR', 'GBP', 'CAD', 'AUD', 'BTC', 'ETH', 'XRP', 'BCH', 'LTC'];
var hardcodedRates = $("#hardcoded li");
function getExchangeRates() {
    $.ajax({
        url: $("#ExchangeRatesLink").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for (let i = 0; i < data['data'].length; i++) {
                var name = data['data'][i].name_quotes.substring(3);
                if (hardcoded.indexOf(name) == -1) {
                    currencyExchangeRates.push(name);
                }
            }
        }
    });
}
function getGlobaldata() {
    $.ajax({
        url: $("#GlobalDataNames").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for (let i = 0; i < data.length; i++) {
                if (hardcoded.indexOf(data[i].symbol) == -1) {
                    currencyExchangeRates.push(data[i].symbol);
                }
            }
        }
    });
}

$(document).ready(function () {
    $("#navigation li").removeClass('active');
    $("#calculatorTab").addClass("active");
    getExchangeRates();
    getGlobaldata();

    $("#to, #from").on('keyup', function (event) {
        var currentItem = $(event.currentTarget);
        //searchListItems = currentItem.siblings('ul');
        searchListItems.html('');
        var key = event.currentTarget.value.toUpperCase();
        searchListItems.append(hardcodedRates.clone());
        $.each(currencyExchangeRates, function (indx) {
            if (currencyExchangeRates[indx].substring(0, key.length) == key) {
                searchListItems.append("<li>" + currencyExchangeRates[indx] + "</li>");
            }
        });
        searchListItems.find('li').on('click', function (event) {
            var selectedItem = $(event.currentTarget);
            var inputSel = selectedItem.parent().siblings('input');
            inputSel.val(selectedItem.text());
            searchListItems.html('');
        });
    });

    //show all drop down list
    $("#to, #from").on('focusin', function (event) {
        var currentItem = $(event.currentTarget);
        //searchListItems = currentItem.siblings('ul');
        searchListItems.html('');
        $.each(currencyExchangeRates, function (indx) {
            searchListItems.append("<li>" + currencyExchangeRates[indx] + "</li>");
        });
    });
    $("#to, #from").on('focusout', function (event) {
        var currentItem = $(event.currentTarget);
        searchListItems = currentItem.siblings('ul');
        searchListItems.html('');
    });
    $("#amount").on('click', function (event) {
        //if ($("#from").length
    });
});
