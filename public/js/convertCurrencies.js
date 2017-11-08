function Currency() {
    this.shortName = "";
    this.fullName = "";
    this.price_usd = "";
    this.isCrypto = "";
}


/*
* update top info
* update big num
*
* */
function updateCurrency() {

}
function updateBigNum(resultCalculateNum) {
    //var bigNum = $(".big-num");
    var inetgerNum = Math.floor(result) + '.';
    $('#inetgerNum').text(inetgerNum);

    resultCalculateNum = resultCalculateNum.toString();
    var doubleIndex = result.indexOf('.');
    if (doubleIndex > 0) {
        var decimal = result.charAt(doubleIndex + 1);
        decimal += result.charAt(doubleIndex + 2);
        $("#decimal").text(decimal);
        var thousands =  result.charAt(doubleIndex + 3);
        thousands +=  result.charAt(doubleIndex + 4);
        thousands +=  result.charAt(doubleIndex + 5);
        $("#thousands").text(thousands);
    }
}
/*
* cal currencies convertor
* return num value
* */
function calculateConvertor(priceUSDFrom, priceUSDTo, numAmount, isCrypto) {
    if(isCrypto) {
        return (numAmount * priceUSDFrom) / priceUSDTo;
    } else {
        return (numAmount * priceUSDTo) / priceUSDFrom;
    }
}
function initalizeFromObject(Currency) {
    Currency.shortName = $("#from").val();
    Currency.price_usd = $("#from").attr('price_usd');
    Currency.isCrypto = $("#from").attr('isCrypto');
    Currency.fullName = $("#fromSecond").val();
}
function initalizeToObject(Currency) {
    Currency.shortName = $("#to").val();
    Currency.price_usd = $("#to").attr('price_usd');
    Currency.isCrypto = $("#to").attr('isCrypto');
    Currency.fullName = $("#toSecond");
}

function runConvertCurrencies() {
    //let numAmount, numFrom, numTo;
    var currencyFrom = new Currency();
    initalizeFromObject(currencyFrom);
    var currencyTo = new Currency();
    initalizeToObject(currencyTo);
    var amount = parseInt($("#amount").val());
    var resultCalculate = calculateConvertor(currencyFrom.price_usd, currencyTo.price_usd, amount, currencyFrom.isCrypto || currencyTo.isCrypto);
    if(Boolean(resultCalculate)) {
        /*update values*/
        updateBigNum(resultCalculate)

    }

}
$(document).ready(function () {
    runConvertCurrencies();
});