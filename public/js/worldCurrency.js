var currentCurrencyInput = $("#currency").val();
var currentCurrency = '';
var inOneDollarCurrency = 0
function putValuesToTable() {

    $.each(currencyExchangeRatesFirst, function(key, value){
        if(value.name == currentCurrencyInput) {
            currentCurrency = value;
        }
    });
    if(currentCurrency == "") {
        $.each(crossRates, function(key, value){
            if(value.name == currentCurrencyInput) {
                currentCurrency = value;
            }
        });
    }
    if(currentCurrency == "") {
        $.each(hardcoded, function(key, value){
            if(value.name == currentCurrencyInput) {
                currentCurrency = value;
            }
        });
    }

    $.each($(".rate_lines th"), function (key, value) {
        putFirstRow(key, value.innerText.trim());
        putSecondRow(key, value.innerText.trim());
    });
}
function putFirstRow(key, value) {
    inOneDollarCurrency = 1 / currentCurrency.price_usd * parseFloat(crossRates[value].price_usd);
    $(".rate_lines1 td")[key + 1].textContent = inOneDollarCurrency.toFixed(5);
}
function putSecondRow(key, value) {

    $(".rate_lines2 td")[key + 1].textContent = (1 / inOneDollarCurrency).toFixed(5);
}
function createRedirectLink(amount, from, to) {
    var location = $("#locationServ").val();
    return location + "/calculator/" + from + "-" + to + "?" + amount;
}
$('#fiat').DataTable({
    "paging": false,
    "ordering": false
});

$('#topTenCrypto').DataTable({
    "paging": false,
    "ordering": false
});
$(".updateLink").on('click', function (event) {
    event.preventDefault();
    var currentItem = $(event.currentTarget);

    var from = currentItem.attr('data-from').toLowerCase();
    var to = currentItem.attr('data-to').toLowerCase();

    localStorage.setItem("amount", '1');
    localStorage.setItem("to", to);
    localStorage.setItem("from", from);
    localStorage.setItem("convert", false);

    window.location = window.location.origin + "/calculator/" + from + "-" + to;
});