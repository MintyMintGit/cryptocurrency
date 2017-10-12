var listSearch = $("#listSearch");
$(document).ready(function () {
    $("#search").on('focusin', function (event) {
        var currentItem = $(event.currentTarget);
        if (currencyExchangeRatesFirst.length > 0) {
            listSearch.append(getListCrypto(currencyExchangeRatesFirst));
        } else if (currencyExchangeRatesSecond > 0) {
            listSearch.append(getListCrypto(currencyExchangeRatesSecond));
        }
    });
});

function getListCrypto(array) {
    var readyListCrypto = [];
    var readyListFiatValues = [];
    var exchangesDouble = [];
    for (var item in array) {
        exchangesDouble.push("<li class='exchangesDouble' is_crypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd +"'>" + array[item].name + "</li>");
        if (array[item].is_crypto == true) {
            readyListCrypto.push("<li class='crypto' is_crypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd +"'>" + array[item].name + "</li>");
        } else {
            readyListFiatValues.push("<li class='notCrypto' is_crypto='" + array[item].is_crypto + "' price_usd='" + array[item].price_usd +"'>" + array[item].name + "</li>");
        }
    }
    //Array.prototype.push.apply(readyList,exchangesDouble);
    Array.prototype.push.apply(exchangesDouble,readyListCrypto);
    Array.prototype.push.apply(exchangesDouble,readyListFiatValues);
    return exchangesDouble;
}