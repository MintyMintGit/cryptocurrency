var bitcoinDateUpdate = $("#bitcoinDateUpdate").val();

/*
* drop down with сurrency
* added click on currency
* */
function сurrencySwitcher(tableJsObj) {
    $(".pointer").on('click', function (event) {
        var dataCurrency = $(event.currentTarget).attr('data-currency');
        var switchButton = $("#currency-switch-button");


        switchButton.append("<span class=\"caret\"></span>");

        // if (dataCurrency == "usd dollar") {
        //     switchButton.text(dataCurrency.toUpperCase() + " ");
        //     dataCurrency = "usd";
        // } else {
        //     switchButton.text(dataCurrency.toUpperCase() + " ");
        // }
        switchButton.text(dataCurrency.toUpperCase() + " ");
        var coefficient = currencyExchangeRatesSecond.attr('data-usd' + dataCurrency);




        //market_cap_usd

        tableJsObj.find('tbody tr .market_cap_usd').each(function (indx, element) {
            if (dataCurrency == "btc") {
                element.innerHTML = parseInt(parseFloat(element.getAttribute('data-usd')) / parseFloat($("#bitcoinPrice").val())) + " BTC";
            } else if (dataCurrency == "eth") {
                element.innerHTML = parseInt(parseFloat(element.getAttribute('data-usd')) / parseFloat($("#ethPrice").val())) + " ETH";
            } else {
                var costInDollars = $(element).attr('data-usd');
                element.innerHTML = mapShortCodetoSymbol(dataCurrency) + makeBeautyMoney(parseFloat(costInDollars) * coefficient);
            }
        });

        //price
        tableJsObj.find('tbody tr .price').each(function (indx, element) {
            if (dataCurrency == "btc") {
                element.innerHTML = (parseFloat(element.getAttribute('data-usd')) / parseFloat($("#bitcoinPrice").val())).toFixed(8) + " BTC";
            } else if (dataCurrency == "eth") {
                element.innerHTML = (parseFloat(element.getAttribute('data-usd')) / parseFloat($("#ethPrice").val())).toFixed(8) + " ETH";
            } else {
                var costInDollars = $(element).attr('data-usd');
                element.innerHTML = mapShortCodetoSymbol(dataCurrency) + (parseFloat(costInDollars) * coefficient).toFixed(6);
            }
        });

        //Volume
        tableJsObj.find('tbody tr .volume').each(function (indx, element) {
            if (dataCurrency == "btc") {
                element.innerHTML = (parseFloat(element.getAttribute('data-usd')) / parseFloat($("#bitcoinPrice").val())).toFixed(3) + " BTC";
            } else if (dataCurrency == "eth") {
                element.innerHTML = (parseFloat(element.getAttribute('data-usd')) / parseFloat($("#ethPrice").val())).toFixed(3) + " ETH";
            } else {
                var costInDollars = $(element).attr('data-usd');
                element.innerHTML = mapShortCodetoSymbol(dataCurrency) + makeBeautyMoney(parseFloat(costInDollars) * coefficient);
            }
        });
        event.preventDefault();
    })
}

/*
* change amount on key Up
*  set value from input to blue text on calc
*/
function changeAmount(amountJQueryObj, amountBlueJQueryObj) {
    amountJQueryObj.on('keyup', function (event) {
        amountBlueJQueryObj.val(amountJQueryObj.val());
        runConvertCurrencies();
    });
}

/*
* set time last update
* return int minutes
* */
function setTimeLastUpdateCryptoValues() {
    var then = moment.unix(bitcoinDateUpdate);
    var now = moment();
    return moment.utc(moment(now).diff(moment(then))).format("mm");
}

function setTimeLastUpdateCryptoValuesMinutes() {
    return setTimeLastUpdateCryptoValues() + ' minutes ago';
}

function findValueInCurrencyExchangeRates(name) {
    var result = "";
    $.each(currencyExchangeRates, function (key, value) {
        if (value.name == name) {
            return result = value
        }
    });
    return result;
}

function findValueInCrossRates(name) {
    return crossRates[name];
}

function findValueInHardCoded(name) {
    return hardcoded[name];
}

function searchFullInfoCurrency(name) {
    var fullInfo = findValueInCrossRates(name);
    if (!fullInfo) {
        fullInfo = findValueInHardCoded(name);
    } else {
        return fullInfo;
    }
    if (!fullInfo) {
        fullInfo = findValueInCurrencyExchangeRates(name);
    }
    return fullInfo;
}
function runTrandingRates() {
    /*try get from anothe is USD*/
    setTimeout(1000);
    $(".to").each(function (indx, element) {

        var currencyFrom = new Currency();
        initalizeFromObject(currencyFrom);
        var from = searchFullInfoCurrency(currencyFrom.shortName);
        currencyFrom.fullName = from.fullName;
        var currencyTo = new Currency();
        //initalizeToObject(currencyTo);
        currencyTo.shortName = element.innerHTML;
        var to = searchFullInfoCurrency(currencyTo.shortName);
        currencyTo.price_usd = to.price_usd;

        // var from = searchFullInfoCurrency(currencyFrom.shortName);
        // var to = searchFullInfoCurrency(currencyTo.shortName);
        if(jQuery.isEmptyObject(currencyExchangeRates) == true) {
            console.log("wait");
            setTimeout(1000);
        }
        if (currencyFrom['shortName'] == "USD") {
            currencyFrom.price_usdOld = 1;
        } else {
            if(currencyFrom['fullName'] != "") {
                currencyFrom.price_usdOld = currencyExchangeRatesHistory[currencyFrom['fullName'].toLowerCase()].price_old;
            } else {
                currencyFrom.price_usdOld = currencyExchangeRatesHistory[currencyFrom['shortName']].price_old;
            }

        }
        if (currencyTo['shortName'] == "USD") {
            currencyTo.price_usdOld = 1;
            currencyTo.price_usd = 1;
        } else {
            if(currencyTo['fullName'] != "") {
                currencyTo.price_usdOld = currencyExchangeRatesHistory[currencyTo['fullName'].toLowerCase()].price_old;
            } else {
                currencyTo.price_usdOld = currencyExchangeRatesHistory[currencyTo['shortName']].price_old;
            }
        }
        // if(currencyTo.price_usd == undefined) {
        //     alert(currencyExchangeRates.length);
        // }
        // currencyTo.price_usdOld = to.price_usdOld;
        // currencyTo.price_usd = to.price_usd;
        // currencyTo.price_usdOld = to.price_usdOld;


        var parent = $(element).parents('.greyBlock');
        if (from.crypto == true) {
            currencyTo.price_usd = 1 / currencyTo.price_usd;
            currencyTo.price_usdOld = 1 / currencyTo.price_usdOld;
        }
        console.log("indx " + indx);
        console.log("runTrandingRates currencyFrom=" + currencyFrom.price_usd);
        console.log("runTrandingRates currencyTo.price_usd " + currencyTo.price_usd);
        console.log("runTrandingRates currencyTo.shortName " + currencyTo.shortName);
        console.log("runTrandingRates currencyFrom.crypto " + currencyFrom.crypto);

        var newPrice = calculateConvertor(currencyFrom.price_usd, currencyTo.price_usd, 1, currencyFrom.crypto);
        console.log("runOldConverter");
        var oldPrice = calculateConvertor(currencyFrom.price_usdOld, currencyTo.price_usdOld, 1, currencyFrom.crypto);
        var result = calculatePercentage(oldPrice, newPrice);

        parent.find('.someValue').text(parseFloat(newPrice).toFixed(5));
        parent.find('.trendingRates').text(result);
        trandingRatesUpdate();
    });
}