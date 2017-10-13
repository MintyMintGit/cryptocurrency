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
                }
            }
        });
    });
    $(".exchange_pair").on('click', function (event) {
        window.location = window.location.href + "/calculator/" + event.currentTarget.getAttribute('id');
    });
    $(".fiat").on('click', function (event) {
        window.location = window.location.href + "/world/" + event.currentTarget.getAttribute('id');
    });
    $(".crypto").on('click', function (event) {
        window.location = window.location.href + "/crypto/" + event.currentTarget.getAttribute('id');
    });
});

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
// function createRedirectLink(amount, from, to) {
//     return window.location.href + "/" + from + "-" + to + "?" + amount;
// }