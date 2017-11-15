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
                        obj.crypto = false;
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
                    obj.crypto = false;
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
                        obj.crypto = true;
                        hardcoded[item] = obj;
                        flag = true;
                    }
                }
                if(!flag) {
                    var obj = {};
                    obj.name = data[i].symbol;
                    obj.price_usd = data[i].price_usd;
                    obj.fullName = "";
                    obj.crypto = true;
                    currencyExchangeRatesFirst.push(obj);
                }
            }
        }
    });
}

$(document).ready(function () {
    getExchangeRates();
    getGlobaldata();
    changeAmount($("#amount"), $("#amountBlue"));

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
    $("#to").val('EUR');
    $("#from").val('USD');

    $("#from").attr('price_usd',hardcoded.USD.price_usd);
    $("#to").attr('price_usd',hardcoded.EUR.price_usd);

    $("#to").click();
    $("#from").click();

    //show all drop down list
    $("#to, #from").on('focusin', function (event) {
        var currentItem = $(event.currentTarget);
        $("#fromAuto li,#toAuto li").remove();
        var ulSelected = $("#" + currentItem.attr('id') + "Auto");


        ulSelected.append(getFullList(currencyExchangeRatesFirst));
        ulSelected.append(getFullList(hardcoded));
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

    $(".desk, .updateLink").on('click', function (event) {
        var currentTarget = $(event.currentTarget);
        var datafrom = currentTarget.attr('data-from');
        var datato = currentTarget.attr('data-to');
        localStorage.setItem("from", datafrom);
        localStorage.setItem("to", datato);
        localStorage.setItem("convert", false);
    });

});
function checkIsConvert() {
    var counter = 0;
    $.each($(".filters.container input"), function (key, element) {
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
    var crypto_from = document.getElementById("from").getAttribute('crypto');
    var to = parseFloat(document.getElementById("to").getAttribute('price_usd'));
    var crypto_to = document.getElementById("to").getAttribute('crypto');

    if(crypto_from == "true" || crypto_to == "true") {
        var result = (amount * from) / to;
    } else {
        var result = (amount * to) / from;
    }
    var tempResult = Math.floor(result) + '.';
    $("#inetgerNum").text(tempResult);
    result = result.toString();
    var doubleIndex = result.indexOf('.');
    if (doubleIndex > 0) {
        $("#inetgerNum").text(Math.floor(result) + ".");
        var decimal = result.charAt(doubleIndex + 1);
        decimal += result.charAt(doubleIndex + 2);
        $("#decimal").text(decimal).trim();
        var thousands =  result.charAt(doubleIndex + 3);
        thousands +=  result.charAt(doubleIndex + 4);
        thousands +=  result.charAt(doubleIndex + 5);
        $("#thousands").text(thousands).trim();
    }
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
    var crypto = selectedItem.attr('crypto');
    var inputSel = id.substring(0, id.indexOf('Auto'));

    inputSel = $("#" + inputSel);
    inputSel.val(selectedItem.text());
    inputSel.attr('price_usd', price_usd);
    inputSel.attr('crypto', crypto);

    $("#fromAuto li,#toAuto li").remove();
    checkIsConvert();
};


function getFullList(array) {
    var readyList = [];

    for (var item in array) {
        readyList.push("<li crypto='" + array[item].crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
    }

    return readyList;
}

function getReadyList(array, key) {
    var readyList = [];

    for (var item in array) {
        if(array[item].name.indexOf(key) != -1 ) {
            readyList.push("<li crypto='" + array[item].crypto + "' price_usd='" + array[item].price_usd +"'>" + array[item].name + "</li>");
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

function TrandingRates(from, to) {
    return (from / to).toFixed(5);
}
function calculatePercentage(old, today) {
    return (1 -(TrandingRates(old, today))).toFixed(5);
}