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
function updateTrandingRates(Currency) {

}
function updateBigNum(resultCalculateNum) {
    var inetgerNum = Math.floor(resultCalculateNum) + '.';
    $('#inetgerNum').text(inetgerNum);

    resultCalculateNum = resultCalculateNum.toString();
    var doubleIndex = resultCalculateNum.indexOf('.');
    if (doubleIndex > 0) {
        var decimal = resultCalculateNum.charAt(doubleIndex + 1);
        decimal += resultCalculateNum.charAt(doubleIndex + 2);
        $("#decimal").text(decimal);
        var thousands =  resultCalculateNum.charAt(doubleIndex + 3);
        thousands +=  resultCalculateNum.charAt(doubleIndex + 4);
        thousands +=  resultCalculateNum.charAt(doubleIndex + 5);
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
    Currency.isCrypto = $("#from").attr('isCrypto')?"true":"false";
    Currency.fullName = $("#fromSecond").val();
}
function initalizeToObject(Currency) {
    Currency.shortName = $("#to").val();
    Currency.price_usd = $("#to").attr('price_usd');
    Currency.isCrypto = $("#to").attr('isCrypto')?"true":"false";
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