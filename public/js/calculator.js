var currencyExchangeRates = [];
var hardcoded = ['USD', 'EUR', 'GBP', 'CAD', 'AUD', 'BTC', 'ETH', 'XRP', 'BCH', 'LTC'];
var crossRates = {'USD': '', 'EUR': '', 'GBP': '', 'CAD': '', 'AUD': '', 'CHF': '', 'INR': '', 'CNY': '', 'JPY': ''};

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
                if (crossRates[name] != undefined) {
                    crossRates[name] = data['data'][i].value_quotes;
                }
            }
            putValuesToTable();
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

        ulSelected.append(getReadyList(hardcoded, key));
        ulSelected.append(getReadyList(currencyExchangeRates, key));

        ulSelected.find('li').on('click', function (event) {
            appendSelectedItem(event);
        });
    });

    //show all drop down list
    $("#to, #from").on('focusin', function (event) {
        var currentItem = $(event.currentTarget);
        $("#fromAuto li,#toAuto li").remove();
        var ulSelected = $("#" + currentItem.attr('id') + "Auto");

        ulSelected.append(getFullList(hardcoded));
        ulSelected.append(getFullList(currencyExchangeRates));
        ulSelected.find('li').on('click', function (event) {
            appendSelectedItem(event);
        });
    });

    $("#inversion, #convert").on('click', function (event) {
        var currentItem = $(event.currentTarget);
        var amount = $("#amount").val();
        var from = $("#from").val();
        var to = $("#to").val();

        switch (currentItem.attr("id")) {
            case "inversion" :
                window.location = createRedirectLink(amount, to, from);
                break;
            case "convert":
                window.location = createRedirectLink(amount, from, to);
                break;
        }
    });


});

function appendSelectedItem(selectedItem) {
    var selectedItem = $(event.currentTarget);
    var id = selectedItem.parent().attr('id');

    var inputSel = id.substring(0, id.indexOf('Auto'));

    inputSel = $("#" + inputSel);
    inputSel.val(selectedItem.text());
    $("#fromAuto li,#toAuto li").remove();
};

function createRedirectLink(amount, from, to) {
    return window.location.href + "/" + from + "-" + to + "?" + amount;
}

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
        if (array[indx].indexOf(item) != -1) {
            readyList.push("<li>" + array[indx] + "</li>");
        }
    });

    return readyList;
}

function putValuesToTable() {
    //putFirstRow();

    $.each($("#crossRatesTable thead th"), function (key, value) {

        if (key > 0) {
            putFirstRow(key, value);
        }
    });
}

function putFirstRow(key, value) {

    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var itemInVhichPutValue = $(body[0]).find('td')[key];
    $(itemInVhichPutValue).text(crossRates[currence]);
}