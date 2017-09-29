$(document).ready(function(){
    $('#marketCapitalizations').DataTable({
        "ajax": "https://api.coinmarketcap.com/v1/ticker/?limit=1000",
        "columns": [
            {"data": "rank"},
            {"data": "name"},
            {"data": "market_cap_usd"},
            {"data": "price_usd"},
            {"data": "total_supply"},
            {"data": "24h_volume_usd"},
            {"data": "percent_change_24h"},
            {"data": ""}
        ]
    });
});