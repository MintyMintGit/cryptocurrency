var listSearch = $("#listSearch");
$(document).ready(function () {
    $("#search").on('keyup', function (event) {
        $.ajax({
            url: $("#searchIn").val() + '/' + $(event.currentTarget).val(),
            dataType: "json",
            type: 'GET',
            success: function (data) {
                if (data.length > 0) {
                    listSearch.find('li').remove();
                    listSearch.append(generateListSearch(data));
                    runClick();
                }
            }
        });
    });
    runClick();

});

function runClick() {
    $(".exchange_pair").on('click', function (event) {
        var param = collectParams(event.currentTarget);
        saveStatistic(param);
        localStorage.setItem("from", param.exchange1);
        localStorage.setItem("to", param.exchange2);
        localStorage.setItem("convert", false);
        window.location = window.location.origin + "/calculator/" + param.exchange1.toLowerCase() + param.exchange2.toLowerCase();
    });
    $(".fiat").on('click', function (event) {
        var param = collectParams(event.currentTarget);
        saveStatistic(param);
        var temp = param.dataContent.toLowerCase();
        temp = temp.replace(' ', '-');
        window.location = window.location.origin + "/world/" + temp + '-exchange-rates';
    });
    $(".crypto").on('click', function (event) {
        var param = collectParams(event.currentTarget);
        saveStatistic(param);
        var temp = param.dataContent.toLowerCase();
        temp = temp.replace(' ', '-');
        window.location = window.location.origin + "/crypto/" + temp;
    });

}

function collectParams(event) {
    var obj = {};
    obj.exchange2 = event.getAttribute("exchange2");
    obj.exchange1 = event.getAttribute("exchange1");
    obj.dataContent = event.getAttribute("data-content");
    obj.class = event.getAttribute("class");
    obj.id = event.getAttribute("id");
    return obj;
}
function generateListSearch(array) {
    var readyList = [];

    $.each(array, function (indx, element) {
        var temp = " ( " + element.profile_long + " )";
        if (element['type'] == "exchange_pair") {
            temp = "";
        }
        readyList.push("<li id='" + element['id']+"'" + " data-title='" + element.profile_long + "' class=" + element['type'] + " data-usd=" + element['price_usd'] + ">" + element['id'] + ( temp ) + "</li>");
    });
    return readyList;
}

function saveStatistic(attr) {
    $.ajax({
        url: $("#saveStatistic").val(),
        dataType: "json",
        type: 'POST',
        data: attr
    });
}
// function createRedirectLink(amount, from, to) {
//     return window.location.href + "/" + from + "-" + to + "?" + amount;
// }