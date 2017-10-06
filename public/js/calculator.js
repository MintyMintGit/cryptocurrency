var currencyExchangeRates = [];
var hardcoded = ['USD', 'EUR', 'GBP', 'CAD', 'AUD', 'BTC', 'ETH', 'XRP', 'BCH', 'LTC'];
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
        var ulSelected = $("#" + currentItem.attr('id') + "Auto");
        $("#fromAuto li,#toAuto li").remove();
        var key = event.currentTarget.value.toUpperCase();

        ///по идее необходим такой же поиск как и далее
        ulSelected.append( getReadyList(hardcoded, key) );
        ulSelected.append( getReadyList(currencyExchangeRates, key) );

        ulSelected.find('li').on('click', function (event) {
            var selectedItem = $(event.currentTarget);
            var id = selectedItem.parent().attr('id');

            var inputSel = id.substring(0, id.indexOf('Auto'));

            inputSel = $("#" + inputSel);
            inputSel.val(selectedItem.text());
            $("#fromAuto li,#toAuto li").remove();
        });
    });

    //show all drop down list
    $("#to, #from").on('focusin', function (event) {
        var currentItem = $(event.currentTarget);
        $("#fromAuto li,#toAuto li").remove();
        var ulSelected = $("#" + currentItem.attr('id') + "Auto");

        ulSelected.append(getFullList(hardcoded));
        ulSelected.append(getFullList(currencyExchangeRates));

    });


});
function getFullList(array) {
    var readyList = [];

    $.each(array, function (indx) {
            readyList.push("<li>" + array[indx] + "</li>");
    });

    return readyList;
}

function getReadyList(array, item) {
    var readyList = [];

    $.each(array, function (indx) {
        if(array[indx].indexOf(item) != -1) {
            readyList.push("<li>" + array[indx] + "</li>");
        }
    });

    return readyList;
}