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

    if (fromFromStorage == 'USD') {
        fromFromStorage = crossRates['USD'];
    } else {
        $.each(currencyExchangeRates, function (indx, element) {
            if (element.name == fromFromStorage) {
                fromFromStorage = element;
            }
        });
        if (fromFromStorage.name == undefined) {
            $.each(hardcoded, function (indx, element) {
                if (element.name == fromFromStorage) {
                    fromFromStorage = element;
                }
            });
        }
    }
    $(".from").append(fromFromStorage.name);
    $(".to").each(function (indx, element) {
        var parent = $(element).parents('.greyBlock');
        var newPrice = TrandingRates(fromFromStorage.price_usd, crossRates[element.innerText].price_usd);
        var oldPrice = TrandingRates(fromFromStorage.price_usdOld, crossRates[element.innerText].price_usdOld);
        var result = calculatePercentage(oldPrice, newPrice);
        parent.find('.someValue').text(crossRates[element.innerText].price_usdOld);
        parent.find('.trendingRates').text(result);
        trandingRatesUpdate();
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
            $(element).hide();
        } else {
            $(element).show();
            $(element).find('.from').text(from);
            $(element).attr('href', '/calculator/' + from + "-" + linkTo);
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
                        obj.fullName = data[i].name;
                        obj.is_crypto = true;
                        hardcoded[item] = obj;
                        flag = true;
                    }
                }
                if (!flag) {
                    var obj = {};
                    obj.name = data[i].symbol;
                    obj.price_usd = data[i].price_usd;
                    obj.fullName = data[i].name;
                    obj.is_crypto = true;
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

    $("#navigation li").removeClass('active');
    $("#calculatorTab").addClass("active");
    getExchangeRates();
    getGlobaldata();
    changeAmount($("#amount"), $("#amountBlue"));

    $("#to, #from").on('keyup', function (event) {
        var currentItem = $(event.currentTarget);
        var dropDownList = currentItem.parent().siblings();
        dropDownList.find('li').remove();
        if (currentItem.val().length > 0) {
            dropDownList.append(getReadyList(hardcoded, currentItem.val().toUpperCase()));
            dropDownList.append(getReadyList(currencyExchangeRates, currentItem.val().toUpperCase()));
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
    $("#to, #from").on('click', function (event) {
        var currentItem = $(event.currentTarget);
        currentItem.val("");
        var dropDownList = currentItem.parent().siblings();
        dropDownList.find('li').remove();

        dropDownList.append(getFullList(hardcoded));
        dropDownList.append(getFullList(currencyExchangeRates));
        dropDownList.show();
        dropDownList.find('li').on('click', function (event) {
            appendSelectedItem(event);
        });
    });

    $("#inversion").on('click', function (event) {
        var currentItem = $(event.currentTarget);
        var amount = $("#amount").val().toLowerCase();
        var from = $("#from").val().toLowerCase();
        var to = $("#to").val().toLowerCase();


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
    Currency.isCrypto = selectedItem.attr('isCrypto');
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
        var selectedItem = $(event.currentTarget);
        var id = selectedItem.parent().attr('id');
        var newCurrency = new Currency();
        initalizeNewObject(newCurrency, selectedItem);

        var inputSel = id.substring(4).toLowerCase();

        inputSel = $("#" + inputSel);
        inputSel.val(selectedItem.text());
        inputSel.attr('price_usd', newCurrency.price_usd);
        inputSel.attr('is_crypto', newCurrency.isCrypto);

        if (id == "autoFrom") {
            updateFromselected(newCurrency);
        } else {
            updateToselected(newCurrency);
        }
    };


    function getFullList(array) {
        var readyList = [];

        for (var item in array) {
            readyList.push("<li class=" + 'textForDropDownMenu' + " iscrypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
        }

        return readyList;
    }

    function getReadyList(array, key) {
        var readyList = [];

        for (var item in array) {
            if (array[item].name.indexOf(key) != -1) {
                readyList.push("<li class=" + 'textForDropDownMenu' + " iscrypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd + "'>" + array[item].name + "</li>");
            }
        }
        return readyList;
    }

    function createRedirectLink(amount, from, to) {
        return window.location.origin + "/calculator/" + from + "-" + to + "?" + amount;
    }