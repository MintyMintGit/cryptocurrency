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
                        obj.price_usdOld = data['data'][i].value_quotesOld;
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
                    obj.price_usdOld = data['data'][i].value_quotesOld;
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
                        obj.price_usdOld = data['data'][i].value_quotesOld;
                        crossRates[name] = obj;
                    }
                }
                //need put values to convert table


            }
            runTrandingRates();

        }
    });
}
function runTrandingRates() {
    /*try get from anothe is USD*/
    var fromFromStorage = "";
    if (localStorage.getItem("from") === null) {
        fromFromStorage = $("#from").val();
    } else {
        fromFromStorage = localStorage.getItem("from").toUpperCase();
    }
    if (!fromFromStorage) {
        return;
    }

    if(fromFromStorage == 'USD') {
        fromFromStorage = crossRates['USD'];
    } else {
        $.each(currencyExchangeRates, function (indx, element) {
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
        // var color = result > 1 ? "green" : "red";
        // parent.find('.trendingRates').append("<div class='green'>" + crossRates[element.innerText].price_usdOld + "</div>")
        parent.find('.someValue').text(crossRates[element.innerText].price_usdOld );
        // parent.find('.trendingRates').append("<div class='" + color + "'>" + result + "</div>");
        parent.find('.trendingRates').text(result);
    });

}

function TrandingRates(from, to) {
    return (from / to).toFixed(5);
}
function calculatePercentage(old, today) {
    return (1 -(TrandingRates(old, today))).toFixed(5);
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
                        obj.price_usdOld = data[i].price_usdOld;
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
            //putValuesToTable();
            checkIsConvert();
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

            $("#amountBlue").text(amountFromStorage.toUpperCase());
            $("#amountToCurrency").text(fromFromStorage.toUpperCase());
            $("#amountFromCurrency").text(toFromStorage.toUpperCase());
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
        $("#amountBlue").text($("#amount").val());
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
    $.each($(".filters.container input"), function (key, element) {
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

    $("#inetgerNum").text(Math.floor(result)).trim();
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
    // $("#decimal").text()
    // $("#thousands")
}

function appendSelectedItem(selectedItem) {
    var selectedItem = $(event.currentTarget);
    var id = selectedItem.parent().attr('id');
    if (id == "toAuto") {
        $("#amountToCurrency").text(selectedItem.text());
    } else {
        $("#amountFromCurrency").text(selectedItem.text());
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
        readyList.push("<li class=" + 'textForDropDownMenu' + " is_crypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
    }

    return readyList;
}

function getReadyList(array, key) {
    var readyList = [];

    for (var item in array) {
        if (array[item].name.indexOf(key) != -1) {
            readyList.push("<li class=" + 'textForDropDownMenu' + " is_crypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
        }
    }
    return readyList;
}

function createRedirectLink(amount, from, to) {
    return window.location.origin + "/calculator/" + from + "-" + to + "?" + amount;
}