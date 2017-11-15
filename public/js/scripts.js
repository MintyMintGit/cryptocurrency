var listSearch = $("#listSearch");
$(document).ready(function () {
    //loadingFullSearchList();
    $("#search_input").on('keyup', function (event) {
        var valueSearchinput = $(event.currentTarget).val();
        if(valueSearchinput <= 0) listSearch.hide();
        $.ajax({
            url: $("#searchIn").val() + '/' + valueSearchinput,
            dataType: "json",
            async: true,
            type: 'GET',
            success: function (data) {
                if (data.length > 0) {
                    listSearch.show();
                    listSearch.find('li').remove();
                    listSearch.append(generateListSearch(data));
                    runClick();
                } else {
                    listSearch.hide();
                }
            }
        });
    });
    //runClick();

});

function runClick() {
    $(".exchange_pair").on('click', function (event) {
        var param = collectParams(event.currentTarget);
        saveStatistic(param);
        // localStorage.setItem("from", param.exchange1);
        // localStorage.setItem("to", param.exchange2);
        // localStorage .setItem("convert", false);
        window.location = window.location.origin + "/calculator/" + param.exchange1.toLowerCase() + '-' + param.exchange2.toLowerCase();
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
    obj.dataContent = event.getAttribute("data-title");
    obj.class = event.getAttribute("class");
    obj.id = event.getAttribute("id");
    return obj;
}
function generateListSearch(array) {
    var readyList = [];

    $.each(array, function (indx, element) {

        if (element['type'] == "exchange_pair") {
            if (element.exchange2 != element.exchange1)
                readyList.push("<li exchange2='" + element.exchange2 +"' exchange1='" + element.exchange1 +"' id='" + element['id']+"' " + " data-title='" + element.profile_long + "' class=" + element['type'] + " data-usd=" + element['price_usd'] + ">" + element['id'] + "</li>");
        } else {
            readyList.push("<li id='" + element['id']+"'" + " data-title='" + element.profile_long + "' class=" + element['type'] + " data-usd=" + element['price_usd'] + ">" + element['id'] + "(" + element.profile_long  + ")" + "</li>");
        }

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

$(document).ready(function () {
    runClick();
    $("#search_input").on('focusin', function (event) {
        $('.search-dpopdown-list').slideToggle().animate({'opacity': 1}, 100);
        $('#searchform').addClass('search-act');
    });
    $("#search_input").on('focusout', function (event) {
        $('.search-dpopdown-list').fadeOut();
        $('#searchform').removeClass('search-act');
    });
    $(".search-dpopdown-list li a").click(function() {
        $('.search-dpopdown-list').toggle();
    });

    $(".search-dpopdown-list li a").click(function() {
        $('.search-dpopdown-list').toggle();
    });

    $(".search-col > button").click(function() {
        $('.menu-mask').prependTo('body');
        // $('.menu-mask').show();
        $('.x').show();
        $('.menu-mask .head-logo').show();
        $('.menu-container').css('padding-top','0');
    });

    $(".x").click(function() {
        $('.menu-mask').appendTo('body');
        $('.x').hide();
        $('.menu-mask .head-logo').hide();
        $('.menu-container').css('padding-top','50px');
    });
    update();
});
function update() {
    var date = moment(new Date())
    $('#datetime').html(date.format('h:mm a, DD.MM.YYYY'));
}
