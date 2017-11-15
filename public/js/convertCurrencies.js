function Currency() {
    this.shortName = "";
    this.fullName = "";
    this.price_usd = "";
    this.crypto = "";
}
/*
* update top info
* */
function TopInfo(from, to, fromFullName, toFullName) {
    if (from) {
        $("#fromThird").text(from);
    }
    if (to) {
        $("#toThird").text(to);
    }
    if (fromFullName != "" && toFullName != "") {
        $("#fromSecond").text(fromFullName);
        $("#toSecond").text(toFullName);
    }
}
function updateBigNumHeader(from, to) {
    if (from) {
        $("#amountFromCurrency").text(from);
    }
    if (to) {
        $("#amountToCurrency").text(to);
    }
}
/*
* update big num
*
* */
function updateBigNum(resultCalculateNum) {
    var inetgerNum = Math.floor(resultCalculateNum) + '.';
    $('#inetgerNum').text(inetgerNum);

    resultCalculateNum = resultCalculateNum.toString();
    var doubleIndex = resultCalculateNum.indexOf('.');
    if (doubleIndex > 0) {
        var decimal = resultCalculateNum.charAt(doubleIndex + 1);
        decimal += resultCalculateNum.charAt(doubleIndex + 2);
        $("#decimal").text(decimal);
        var thousands = resultCalculateNum.charAt(doubleIndex + 3);
        thousands += resultCalculateNum.charAt(doubleIndex + 4);
        thousands += resultCalculateNum.charAt(doubleIndex + 5);
        $("#thousands").text(thousands);
    }
}

/*
* cal currencies convertor
* return num value
* */
function calculateConvertor(priceUSDFrom, priceUSDTo, numAmount, crypto) {
    if (crypto === "true" || crypto == true) {
        return (numAmount * priceUSDFrom) / priceUSDTo;
    } else {
        return (numAmount * priceUSDTo) / priceUSDFrom;
    }
}

function initalizeFromObject(Currency) {
    Currency.shortName = $("#from").val();
    Currency.price_usd = $("#from").attr('price_usd');
    Currency.crypto = $("#from").attr('crypto') == "" ? "false": $("#from").attr('crypto') == "1" ? "true": $("#from").attr('crypto');
    Currency.fullName = $("#fromSecond").text();
}

function initalizeToObject(Currency) {
    Currency.shortName = $("#to").val();
    Currency.price_usd = $("#to").attr('price_usd');
    Currency.crypto = $("#to").attr('crypto') == "" ? "false": $("#to").attr('crypto') == "1" ? "true" :$("#to").attr('crypto');
    Currency.fullName = $("#toSecond").text();
}

function runConvertCurrencies() {
    //let numAmount, numFrom, numTo;
    var currencyFrom = new Currency();
    initalizeFromObject(currencyFrom);
    var currencyTo = new Currency();
    initalizeToObject(currencyTo);
    var amount = parseInt($("#amount").val());

    if (currencyTo.crypto == "true") {
        if (currencyFrom.crypto == "false") {
            currencyFrom.price_usd = 1 / currencyFrom.price_usd;
        }
    }
    if (currencyFrom.crypto == "true") {
        if (currencyTo.crypto == "false") {
            currencyTo.price_usd = 1 / currencyTo.price_usd;
        }
    }

    var flag = currencyFrom.crypto;
    if(currencyTo.crypto == "true") {
        flag = "true";
    }

    var resultCalculate = calculateConvertor(currencyFrom.price_usd, currencyTo.price_usd, amount, flag);

    if (Boolean(resultCalculate)) {
        /*update values*/
        updateBigNum(resultCalculate)

    }
    runTrandingRates();
}

$(document).ready(function () {
    runConvertCurrencies();
});