function Currency() {
    this.shortName = "";
    this.fullName = "";
    this.price_usd = "";
    this.isCrypto = "";
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
function calculateConvertor(priceUSDFrom, priceUSDTo, numAmount, isCrypto) {
    if (isCrypto == "true") {
        return (numAmount * priceUSDFrom) / priceUSDTo;
    } else {
        return (numAmount * priceUSDTo) / priceUSDFrom;
    }
}

function initalizeFromObject(Currency) {
    Currency.shortName = $("#from").val();
    Currency.price_usd = $("#from").attr('price_usd');
    Currency.isCrypto = $("#from").attr('isCrypto') ? "true" : "false";
    Currency.fullName = $("#fromSecond").val();
}

function initalizeToObject(Currency) {
    Currency.shortName = $("#to").val();
    Currency.price_usd = $("#to").attr('price_usd');
    Currency.isCrypto = $("#to").attr('isCrypto') ? "true" : "false";
    Currency.fullName = $("#toSecond");
}

function runConvertCurrencies() {
    //let numAmount, numFrom, numTo;
    var currencyFrom = new Currency();
    initalizeFromObject(currencyFrom);
    var currencyTo = new Currency();
    initalizeToObject(currencyTo);
    var amount = parseInt($("#amount").val());
    var flag = currencyFrom.isCrypto;
    if(currencyTo.isCrypto == "true") {
        flag = true;
    }
    var resultCalculate = calculateConvertor(currencyFrom.price_usd, currencyTo.price_usd, amount, flag);
    if (Boolean(resultCalculate)) {
        /*update values*/
        updateBigNum(resultCalculate)

    }

}

$(document).ready(function () {
    runConvertCurrencies();
});