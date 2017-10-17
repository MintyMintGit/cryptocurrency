var currencyExchangeRates = [];
var hardcoded = {
    'USD': {},
    'EUR': {},
    'GBP': {},
    'CAD': {},
    'AUD': {},
    'BTC': {},
    'ETH': {},
    'XRP': {},
    'BCH': {},
    'LTC': {}
};
var crossRates = {'USD': {}, 'EUR': {}, 'GBP': {}, 'CAD': {}, 'AUD': {}, 'CHF': {}, 'INR': {}, 'CNY': {}, 'JPY': {}};

function getExchangeRates() {
    $.ajax({
        url: $("#ExchangeRatesLink").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            var from = $("#from");
            var to = $("#to");
            for (let i = 0; i < data['data'].length; i++) {
                var name = data['data'][i].name_quotes.substring(3);
                if(name == from.val()) {
                    from.attr('is_crypto', false);
                    from.attr('price_usd', data['data'][i].value_quotes);
                }
                if (name == to.val()) {
                    to.attr('is_crypto', false);
                    to.attr('price_usd', data['data'][i].value_quotes);
                }
                var flag = false;
                for (var item in hardcoded) {
                    if (item == name) {
                        var obj = {};
                        obj.name = name;
                        obj.price_usd = data['data'][i].value_quotes;
                        obj.fullName = "";
                        obj.is_crypto = false;
                        hardcoded[item] = obj;
                        flag = true;
                    }
                }
                if (!flag) {
                    var obj = {};
                    obj.name = name;
                    obj.price_usd = data['data'][i].value_quotes;
                    obj.fullName = "";
                    obj.is_crypto = false;
                    currencyExchangeRates.push(obj);
                }
                for (var item in crossRates) {
                    if (item == name) {
                        var obj = {};
                        obj.name = name;
                        obj.price_usd = data['data'][i].value_quotes;
                        obj.fullName = "";
                        crossRates[name] = obj;
                    }
                }
                //need put values to convert table


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
            var from = $("#from");
            var to = $("#to");
            for (let i = 0; i < data.length; i++) {


                if(data[i].symbol == from.val()) {
                    from.attr('is_crypto', true);
                    from.attr('price_usd', data[i].price_usd);
                }
                if (data[i].symbol == to.val()) {
                    to.attr('is_crypto', true);
                    //to.attr('price_usd', data['data'][i].price_usd);
                    to.attr('price_usd', data[i].price_usd);
                }

                var flag = false;

                for (var item in hardcoded) {
                    if (item == data[i].symbol) {
                        var obj = {};
                        obj.name = data[i].symbol;
                        obj.price_usd = data[i].price_usd;
                        obj.fullName = "";
                        obj.is_crypto = true;
                        hardcoded[item] = obj;
                        flag = true;
                    }
                }
                if (!flag) {
                    var obj = {};
                    obj.name = data[i].symbol;
                    obj.price_usd = data[i].price_usd;
                    obj.fullName = "";
                    obj.is_crypto = true;
                    currencyExchangeRates.push(obj);
                }
            }
        }
    });
}

$(document).ready(function () {

    var amountFromStorage = localStorage.getItem("amount");
    var fromFromStorage = localStorage.getItem("from");
    var toFromStorage = localStorage.getItem("to");
    var convert = localStorage.getItem("convert");
    if (convert == "true") {
        if(amountFromStorage && fromFromStorage && toFromStorage) {
            $("#amount").val(amountFromStorage.toUpperCase());
            $("#from").val(toFromStorage.toUpperCase());
            $("#to").val(fromFromStorage.toUpperCase());
        }
    } else if(fromFromStorage && toFromStorage) {
        $("#amount").val( amountFromStorage != null ? amountFromStorage.toUpperCase() : 1);
        $("#from").val(fromFromStorage.toUpperCase());
        $("#to").val(toFromStorage.toUpperCase());
    }


    $("#navigation li").removeClass('active');
    $("#calculatorTab").addClass("active");
    getExchangeRates();
    getGlobaldata();
    $("#amount").on('change', function (event) {
        checkIsConvert();
    });
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

    $("#inversion").on('click', function (event) {
        var currentItem = $(event.currentTarget);
        var amount = $("#amount").val().toLowerCase();
        var from = $("#from").val().toLowerCase();
        var to = $("#to").val().toLowerCase();


        localStorage.setItem("amount", amount);
        localStorage.setItem("from", from);
        localStorage.setItem("to", to);
        localStorage.setItem("convert", true);

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

function checkIsConvert() {
    var counter = 0;
    $.each($("#converterTable input"), function (key, element) {
        if (element.value != '') {
            counter++;
        }
        if (counter == 3) {
            convert();
        }
    });
}

function convert() {
    var amount = parseInt(document.getElementById("amount").value);
    var from = parseFloat(document.getElementById("from").getAttribute('price_usd'));
    var is_crypto_from = document.getElementById("from").getAttribute('is_crypto');
    var to = parseFloat(document.getElementById("to").getAttribute('price_usd'));
    var is_crypto_to = document.getElementById("to").getAttribute('is_crypto');

    if (is_crypto_from == "true" || is_crypto_to == "true") {
        var result = (amount * from) / to;
    } else {
        var result = (amount * to) / from;
    }
    document.getElementById("result").innerHTML = result;
}

function appendSelectedItem(selectedItem) {
    var selectedItem = $(event.currentTarget);
    var id = selectedItem.parent().attr('id');
    var price_usd = selectedItem.attr('price_usd');
    var is_crypto = selectedItem.attr('is_crypto');
    var inputSel = id.substring(0, id.indexOf('Auto'));

    inputSel = $("#" + inputSel);
    inputSel.val(selectedItem.text());
    inputSel.attr('price_usd', price_usd);
    inputSel.attr('is_crypto', is_crypto);

    $("#fromAuto li,#toAuto li").remove();
    checkIsConvert();
};


function getFullList(array) {
    var readyList = [];

    for (var item in array) {
        readyList.push("<li is_crypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
    }

    return readyList;
}

function getReadyList(array, key) {
    var readyList = [];

    for (var item in array) {
        if (array[item].name.indexOf(key) != -1) {
            readyList.push("<li is_crypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
        }
    }
    return readyList;
}

function putValuesToTable() {
    checkIsConvert();
    $.each($("#crossRatesTable thead th"), function (key, value) {

        if (key > 0) {
            putFirstRow(key, value);
            putSecondRow(key, value);
            putThirdRow(key, value);
            putFourthRow(key, value);
            putFifthRow(key, value);
            putSixthRow(key, value);
            putSeventhRow(key, value);
            putEigthRow(key, value);
        }
    });
}

function putFirstRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var itemInVhichPutValue = $(body[0]).find('td')[key];
    $(itemInVhichPutValue).text(crossRates[currence].price_usd);
}

function putSecondRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var itemInVhichPutValue = $(body[1]).find('td')[key];
    var temp = 1 / crossRates[currence].price_usd;
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function putThirdRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var oneEuro = 1 / crossRates.EUR.price_usd;
    var itemInVhichPutValue = $(body[2]).find('td')[key];
    var temp = oneEuro * crossRates[currence].price_usd;
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function putFourthRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var oneEuro = 1 / crossRates.EUR.price_usd;
    var itemInVhichPutValue = $(body[3]).find('td')[key];
    var temp = 1 / (oneEuro * crossRates[currence].price_usd);
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function putFifthRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var oneGBP = 1 / crossRates.GBP.price_usd;
    var itemInVhichPutValue = $(body[4]).find('td')[key];
    var temp = oneGBP * crossRates[currence].price_usd;
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function putSeventhRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var oneGBP = 1 / crossRates.GBP.price_usd;
    var itemInVhichPutValue = $(body[5]).find('td')[key];
    var temp = 1 / (oneGBP * crossRates[currence].price_usd);
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function putEigthRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var oneBTC = 1 / parseFloat($("#bitcoinPrice").val());
    var itemInVhichPutValue = $(body[6]).find('td')[key];
    var temp = oneBTC * crossRates[currence].price_usd;
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function putSixthRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var oneBTC = 1 / parseFloat($("#bitcoinPrice").val());
    var itemInVhichPutValue = $(body[7]).find('td')[key];
    var temp = 1 / (oneBTC * crossRates[currence].price_usd);
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function createRedirectLink(amount, from, to) {
    return window.location.origin + "/calculator/" + from + "-" + to + "?" + amount;
}