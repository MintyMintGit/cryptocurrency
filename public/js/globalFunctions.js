var bitcoinDateUpdate = $("#bitcoinDateUpdate").val();

/*
* drop down with сurrency
* added click on currency
* */
    function сurrencySwitcher(tableJsObj) {
    $(".pointer").on('click', function (event) {
        dataCurrency = $(event.currentTarget).attr('data-currency');
        coefficient = currencyExchangeRatesSecond.attr('data-usd' + dataCurrency);
        var switchButton = $("#currency-switch-button");

        switchButton.text(dataCurrency.toUpperCase() + " ");
        switchButton.append("<span class=\"caret\"></span>");

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
                element.innerHTML = mapShortCodetoSymbol(dataCurrency) + (parseFloat(costInDollars) * coefficient).toFixed(2);
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
        checkIsConvert();
    });
}
/*
* set time last update
* return int minutes
* */
function setTimeLastUpdateCryptoValues() {
    var then = moment.unix(bitcoinDateUpdate);
    var now  = moment();
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