var currencyExchangeRatesFirst = [];
var hardcoded = {'USD' : {}, 'EUR': {}, 'GBP': {}, 'CAD': {}, 'AUD': {}, 'BTC': {}, 'ETH': {}, 'XRP': {}, 'BCH': {}, 'LTC': {}};
var crossRates = {'USD': {}, 'EUR': {}, 'GBP': {}, 'CAD': {}, 'AUD': {}, 'CHF': {}, 'INR': {}, 'CNY': {}, 'JPY': {}};

function getExchangeRates() {
    $.ajax({
        url: $("#ExchangeRatesLink").val(),
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for (let i = 0; i < data['data'].length; i++) {
                var name = data['data'][i].name_quotes.substring(3);

                var flag = false;
                for (var item in hardcoded) {
                    if(item == name) {
                        var obj = {};
                        obj.name = name;
                        obj.price_usd = data['data'][i].value_quotes;
                        obj.price_usdOld = data['data'][i].value_quotesOld;
                        obj.fullName = "";
                        obj.is_crypto = false;
                        hardcoded[item] = obj;
                        flag = true;
                    }
                }
                if(!flag) {
                    var obj = {};
                    obj.name = name;
                    obj.price_usd = data['data'][i].value_quotes;
                    obj.price_usdOld = data['data'][i].value_quotesOld;
                    obj.fullName = "";
                    obj.is_crypto = false;
                    currencyExchangeRatesFirst.push(obj);
                }
                for (var item in crossRates) {
                    if(item == name) {
                        var obj = {};
                        obj.name = name;
                        obj.price_usd = data['data'][i].value_quotes;
                        obj.price_usdOld = data['data'][i].value_quotesOld;
                        obj.fullName = "";
                        crossRates[name] = obj;
                    }
                }
            }

            //runTrandingRates();
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

                var flag = false;

                for (var item in hardcoded) {
                    if (item == data[i].symbol) {
                        var obj = {};
                        obj.name = data[i].symbol;
                        obj.price_usd = data[i].price_usd;
                        obj.price_usdOld = data[i].value_quotesOld;
                        obj.fullName = "";
                        obj.is_crypto = true;
                        hardcoded[item] = obj;
                        flag = true;
                    }
                }
                if(!flag) {
                    var obj = {};
                    obj.name = data[i].symbol;
                    obj.price_usd = data[i].price_usd;
                    obj.fullName = "";
                    obj.is_crypto = true;
                    currencyExchangeRatesFirst.push(obj);
                }
            }
        }
    });
}

$(document).ready(function () {
    getExchangeRates();
    getGlobaldata();
    $("#amount").on('change', function (event) {
        checkIsConvert();
        $("#amountBlue").text($("#amount").val());
    });
    $("#to, #from").on('keyup', function (event) {
        var currentItem = $(event.currentTarget);
        var ulSelected = $("#" + currentItem.attr('id') + "Auto");
        $("#fromAuto li,#toAuto li").remove();
        var key = event.currentTarget.value.toUpperCase();

        ulSelected.append(getReadyList(hardcoded, key));
        ulSelected.append(getReadyList(currencyExchangeRatesFirst, key));

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
        ulSelected.append(getFullList(currencyExchangeRatesFirst));
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

    $(".linkGreyBlock").on('click', function (event) {
        var from = $(event.currentTarget).find('.from').text();
        var to = $(event.currentTarget).find('.to').text();
        localStorage.setItem("from", from);
        localStorage.setItem("to", to);
        localStorage.setItem("convert", false);
    });
});
function checkIsConvert() {
    var counter = 0;
    $.each($("#converterTable input"), function (key, element) {
        if(element.value != '') {
            counter++;
        }
        if(counter == 3) {
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

    if(is_crypto_from == "true" || is_crypto_to == "true") {
        var result = (amount * from) / to;
    } else {
        var result = (amount * to) / from;
    }
    document.getElementById("result").innerHTML = result;
}
function appendSelectedItem(selectedItem) {
    var selectedItem = $(event.currentTarget);
    var id = selectedItem.parent().attr('id');
    if (id == "toAuto") {
        $("#amountToCurrency").text(selectedItem.text());
    } else {
        $("#amountFromCurrency").text(selectedItem.text());

        /*update cross rates*/

        $(".linkGreyBlock").each(function(indx, element){
            var from = $("#amountFromCurrency").text();
            var linkTo = $(element).find('.to').text();
            $(element).find('.from').text(from);
            $(element).attr('href', 'calculator/' + from + "-" + linkTo);
        });
        /**/
    }

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
        if(array[item].name.indexOf(key) != -1 ) {
            readyList.push("<li is_crypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd +"'>" + array[item].name + "</li>");
        }
    }
    return readyList;
}

function putValuesToTable() {

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
    var itemInVhichPutValue = $(body[7]).find('td')[key];
    var temp = oneBTC / crossRates[currence].price_usd;
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function putSixthRow(key, value) {
    var body = $("#crossRatesTable tbody tr");
    var currence = $(value).find('p').html();
    var oneBTC = parseFloat($("#bitcoinPrice").val());
    var itemInVhichPutValue = $(body[6]).find('td')[key];
    var temp = oneBTC / (1 / crossRates[currence].price_usd);
    //var temp = 1 / (oneBTC * crossRates[currence].price_usd);
    $(itemInVhichPutValue).text(temp.toFixed(5));
}

function createRedirectLink(amount, from, to) {
    return window.location.href + "calculator/" + from + "-" + to + "?" + amount;
}
function runTrandingRates() {
    /*try get from anothe is USD*/
    if (localStorage.getItem("from") !== null) {
        var fromFromStorage = localStorage.getItem("from").toUpperCase();
        if(fromFromStorage == 'USD') {
            fromFromStorage = crossRates['USD'];
        } else {
            $.each(currencyExchangeRatesFirst, function (indx, element) {
                if(element.name == fromFromStorage) {
                    fromFromStorage = element;
                }
            });
            if(fromFromStorage.name == undefined) {
                $.each(hardcoded, function (indx, element) {
                    if(element.name == fromFromStorage) {
                        fromFromStorage = element;
                    }
                });
            }
        }
        $(".from").append(fromFromStorage.name);
        $(".to").each(function(indx, element){
            var parent = $(element).parents('.greyBlock');
            var newPrice = TrandingRates(fromFromStorage.price_usd, crossRates[element.innerText].price_usd);
            var oldPrice = TrandingRates(fromFromStorage.price_usdOld, crossRates[element.innerText].price_usdOld);
            var result = calculatePercentage(oldPrice, newPrice);
            var color = result > 1 ? "green" : "red";
            parent.find('.trendingRates').append("<div class='green'>" + crossRates[element.innerText].price_usdOld + "</div>")
            parent.find('.trendingRates').append("<div class='" + color + "'>" + result + "</div>");
        });
    }
}

function TrandingRates(from, to) {
    return (from / to).toFixed(5);
}
function calculatePercentage(old, today) {
    return (1 -(TrandingRates(old, today))).toFixed(5);
}