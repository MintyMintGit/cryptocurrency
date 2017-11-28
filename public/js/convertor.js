var currencyExchangeRates = [];
var currencyExchangeRatesHistory = {};
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
var hardCodedCounterCrypto = 5;
var hardCodedCounterFiat = 5;
var crossRates = {
    'USD': {},
    'EUR': {},
    'GBP': {},
    'CAD': {},
    'AUD': {},
    'CHF': {},
    'INR': {},
    'CNY': {},
    'JPY': {},
    'BRL': {}
};

function getExchangeRatesHistory() {
    $.ajax({
        url: '/api/getExchangeRatesHistory',
        dataType: "json",
        type: 'GET',
        success: function (data) {
            for (let i = 0; i < data.length; i++) {
                currencyExchangeRatesHistory[data[i].name] = data[i];
            }
            changeAmount($("#amount"), $("#amountBlue"));
            runConvertCurrencies();
        }
    });
}


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
                if (name == from.val()) {
                    from.attr('crypto', false);
                    from.attr('price_usd', data['data'][i].value_quotes);
                }
                if (name == to.val()) {
                    to.attr('crypto', false);
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
                        obj.crypto = false;
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
                    obj.crypto = false;
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


        }
    });
}

function TrandingRates(from, to) {
    return (from / to).toFixed(5);
}

function calculatePercentage(old, today) {
    return (1 - (TrandingRates(old, today))).toFixed(5);
}

    function trandingRatesUpdate() {
    $(".linkGreyBlock").each(function (indx, element) {
        var from = $("#amountFromCurrency").text();
        var linkTo = $(element).find('.to').text();
        if (from == linkTo) {
            $(element).parent().hide();
        } else {
            $(element).parent().show();
            $(element).find('.from').text(from);
            $(element).attr('href', '/calculator/' + from.toLowerCase() + "-" + linkTo.toLowerCase());
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


                if (data[i].symbol == from.val()) {
                    from.attr('crypto', true);
                    from.attr('price_usd', data[i].price_usd);
                }
                if (data[i].symbol == to.val()) {
                    to.attr('crypto', true);
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
                        obj.fullName = data[i].name;
                        obj.crypto = true;
                        hardcoded[item] = obj;
                        flag = true;
                    }
                }
                if (!flag) {
                    var obj = {};
                    obj.name = data[i].symbol;
                    obj.price_usd = data[i].price_usd;
                    obj.fullName = data[i].name;
                    obj.crypto = true;
                    currencyExchangeRates.push(obj);
                }
            }

        }
    });
}

function updateOneTopInfo(value, DestjQueryObj) {
    var value = searchFullInfoCurrency(value);
    if (value) {
        DestjQueryObj.html(value.fullName);
    }
}


function updateTopInfo(from, to, fromJQueryObj, toJQueryObj) {
    var fromFull = searchFullInfoCurrency(from);
    var toFull = searchFullInfoCurrency(to);
    if (fromFull != null && toFull != null) {
        /*need update code*/
        fromJQueryObj.html(fromFull.fullName);
        toJQueryObj.html(toFull.fullName);
    }
}

function checkIsUpdateTopInfo(updateJqueryObj, destinationJqueryObj) {
    let temp = updateJqueryObj.val();
    if (temp) {
        destinationJqueryObj.html(temp);
    }
}

$(document).ready(function () {

    $(document).on('click', function (e) {
        if (!$(e.target).closest(".calc-custom-form .input-wrap").length) {
            if ($(e.target).is('li')) {
                $(e.target).parent().hide();
            } else {
                $('.calc-custom-form .dropdown').hide();
            }

        }
        e.stopPropagation();
    });

    $("#updatedLast").html(setTimeLastUpdateCryptoValuesMinutes());

    var dataModalWindow = $("#dataModalWindow");
    var date = moment(new Date());
    dataModalWindow.html(date.format('dddd, MMMM Do, YYYY') + ', ' + 'week ' + date.week());

    // $("#navigation li").removeClass('active');
    // $("#calculatorTab").addClass("active");
    getExchangeRates();
    getGlobaldata();
    getExchangeRatesHistory();

    $("#amount").on('keyup', function (event) {
        $("#amountBlue").text(event.currentTarget.value);
    });

    $("#to, #from").on('keyup', function (event) {
        var currentItem = $(event.currentTarget);
        var dropDownList = currentItem.parent().siblings();
        dropDownList.find('li').remove();
        if (currentItem.val().length > 0) {
            //dropDownList.append(getFullListHarcoded(hardcoded, currentItem.val().toUpperCase()));
            dropDownList.append(getReadyList(currencyExchangeRates, currentItem.val().toUpperCase()));
            dropDownList.append(getReadyList(hardcoded, currentItem.val().toUpperCase()));
            dropDownList.show();
            dropDownList.find('li').on('click', function (event) {
                appendSelectedItem(event);
            });
        } else {
            //dropDownList.hide();
            dropDownList.append(getFullList(hardcoded));
            dropDownList.append(getFullList(currencyExchangeRates));

            dropDownList.find('li').on('click', function (event) {
                appendSelectedItem(event);
            });

        }

    });
    //
    // //show all drop down list

    $(".input-wrap").on('click', function (event) {
        var currentItem = $(event.currentTarget);
        var input = currentItem.find('input');
        input.val("");
        var dropDownList = currentItem.siblings();
        dropDownList.find('li').remove();

        dropDownList.append(getFullListHarcoded(hardcoded, input.val().toUpperCase()));
        dropDownList.append(getFullList(currencyExchangeRates));
        dropDownList.show();
        dropDownList.find('li').on('click', function (event) {
            appendSelectedItem(event);
        });
    });

    $("#inversion").on('click', function (event) {
        event.preventDefault();
        var currentItem = $(event.currentTarget);

        var amount = document.getElementById("amount").getAttribute('value').toLowerCase();
        var from = document.getElementById("from").getAttribute('value').toLowerCase();
        var to = document.getElementById("to").getAttribute('value').toLowerCase();

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



function initalizeNewObject(Currency, selectedItem) {
    Currency.shortName = selectedItem.text().trim();
    Currency.price_usd = selectedItem.attr('price_usd');
    Currency.crypto = selectedItem.attr('crypto');
    Currency.fullName = "";
}

    function updateFromselected(Currency) {
        TopInfo(Currency.shortName);
        updateBigNumHeader(Currency.shortName);
        trandingRatesUpdate();
        runConvertCurrencies();
    }

    function updateToselected(Currency) {
        TopInfo("",Currency.shortName);
        updateBigNumHeader("", Currency.shortName);
        runConvertCurrencies();
    }

    function appendSelectedItem(selectedItem) {
        var selectedItem = $(selectedItem.currentTarget);
        var id = selectedItem.parent().attr('id');
        var newCurrency = new Currency();
        initalizeNewObject(newCurrency, selectedItem);

        var inputSel = id.substring(4).toLowerCase();

        inputSel = $("#" + inputSel);
        inputSel.attr('value', selectedItem.text());
        inputSel.val(selectedItem.text());
        inputSel.attr('price_usd', newCurrency.price_usd);
        inputSel.attr('crypto', newCurrency.crypto);

        if (id == "autoFrom") {
            updateFromselected(newCurrency);
        } else {
            updateToselected(newCurrency);
        }
        runTrandingRates();
    };


function getFullListHarcoded(array) {
    var readyList = [];
    var counter = 0;
    for (var item in array)
    {
        counter++;
        if (counter == hardCodedCounterFiat || counter == hardCodedCounterCrypto + hardCodedCounterFiat) {
            readyList.push("<li class=" + "'borderLineBottom textForDropDownMenu'" + " crypto='" + array[item].crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
        } else {
            readyList.push("<li class=" + 'textForDropDownMenu' + " crypto='" + array[item].crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
        }
    }
    return readyList;
}

function getFullList(array) {
    var readyList = [];

    for (var item in array) {
        readyList.push("<li class=" + 'textForDropDownMenu' + " crypto='" + array[item].crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
    }

    return readyList;
}


    function getReadyList(array, key) {
        var readyList = [];

        for (var item in array) {
            if(array[item].name.substring(0, key.length) == key) {
            //if (array[item].name.indexOf(key) != -1) {
                readyList.push("<li class=" + 'textForDropDownMenu' + " crypto='" + array[item].crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
            }
        }
        return readyList;
    }

    function createRedirectLink(amount, from, to) {
        return window.location.origin + "/calculator/" + from + "-" + to + "?" + amount;
    }