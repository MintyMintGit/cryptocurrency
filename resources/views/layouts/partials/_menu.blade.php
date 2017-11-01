<section class="menu-mask">
    <a href="{{ route('startPage') }}">
        <div class="head-logo">Crypto Converter</div>
    </a>
    <div class="x"></div>
    <div class="container-fluid menu-container">
        <div class="row">
            <div class="col-md-4 nav">
                <h3>Menu</h3>
                <ul>
                    <li><a href="{{ route('calculator') }}"><i class="fa fa-calculator" aria-hidden="true"></i>Currency calculator<img class="arrow" width="27" height="19" src="img/arrow-right.png"></a></li>
                    <li><a href="{{ route('crypto') }}"><i class="fa fa-btc" aria-hidden="true"></i>Crypto Currencies Profile<img class="arrow" width="27" height="19" src="img/arrow-right.png"></a></li>
                    <li><a href="{{ route('world') }}"><i class="fa fa-globe" aria-hidden="true"></i>World Currencies profile<img class="arrow" width="27" height="19" src="img/arrow-right.png"></a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>Convert:</h3>
                <ul>
                    <li exchange2="EUR" exchange1="USD" id="USDEUR" data-title="" class="exchange_pair" data-usd="0">USD to EUR</li>
                    <li exchange2="BTC" exchange1="USD" id="USDBTC" data-title="" class="exchange_pair" data-usd="0">USD to BTC</li>
                    <li exchange2="USD" exchange1="BTC" id="BTCUSD" data-title="" class="exchange_pair" data-usd="0">BTC to USD</li>
                    <li exchange2="EUR" exchange1="BTC" id="BTCEUR" data-title="" class="exchange_pair" data-usd="0">BTC to EUR</li>
                    <li exchange2="USD" exchange1="AUD" id="AUDUSD" data-title="" class="exchange_pair" data-usd="0">AUD to USD</li>
                    <li exchange2="USD" exchange1="EUR" id="EURUSD" data-title="" class="exchange_pair" data-usd="0">EUR to USD</li>
                    <li exchange2="CAD" exchange1="BTC" id="BTCCAD" data-title="" class="exchange_pair" data-usd="0">BTC to CAD</li>
                    <li exchange2="AUD" exchange1="BTC" id="BTCAUD" data-title="" class="exchange_pair" data-usd="0">BTC to AUD</li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>Cryptocurrency:</h3>
                <ul>
                    <li data-title="US Dollar" id="USD" class="fiat">USD (US Dollar)</li>
                    <li data-title="Euro" id="EUR" class="fiat">EUR (Euro)</li>
                    <li data-title="Canadian Dollar" id="CAD" class="fiat">Canadian Dollar</li>
                    <li data-title="Japanese Yen" id="JPY" class="fiat">Japanese Yen</li>
                    <li data-title="Australian Dollar" id="AUD" class="fiat">Australian Dollar</li>
                    <li data-title="Swiss Franc" id="Swiss Franc" class="fiat">Swiss Franc</li>
                    <li data-title="Chinese Yuan Renminbi" id="CNY" class="fiat">Chinese Yuan Renminbi</li>
                    <li data-title="Croatian Kuna" id="HRK" class="fiat">Croatian Kuna</li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>Fiat currency:</h3>
                <ul>
                    <li data-title="Bitcoin" id="BTC" class="crypto">Bitcoin</li>
                    <li data-title="Ethereum" id="ETH" class="crypto">Ethereum</li>
                    <li data-title="Ripple" id="XRP" class="crypto">Ripple</li>
                    <li data-title="Bitcoin Cash" id="BCH" class="crypto">Bitcoin Cash</li>
                    <li data-title="Litecoin" id="LTC" class="crypto">Litecoin</li>
                    <li data-title="Dashcoin" id="DASH" class="crypto">Dashcoin</li>
                    <li data-title="NEO" id="NEO" class="crypto">NEO</li>
                    <li data-title="NEM" id="XEM" class="crypto">NEM</li>
                </ul>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <footer class="menu-footer footer">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-xs-12 total">Total Market Cap: $172,759,034,864</div>
            <div class="col-sm-6 col-md-6 col-xs-12 date" id="datetime"></div>
        </div>
    </footer>
</section>