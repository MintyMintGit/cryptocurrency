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
                    <li><a href="{{ route('calculator') }}"><i class="fa fa-calculator" aria-hidden="true"></i>Currency calculator<img class="arrow" width="27" height="19" src="{{ route('startPage') }}/img/arrow-right.png"></a></li>
                    <li><a href="{{ route('crypto') }}"><i class="fa fa-btc" aria-hidden="true"></i>Crypto Currencies Profile<img class="arrow" width="27" height="19" src="{{ route('startPage') }}/img/arrow-right.png"></a></li>
                    <li><a href="{{ route('world') }}"><i class="fa fa-globe" aria-hidden="true"></i>World Currencies profile<img class="arrow" width="27" height="19" src="{{ route('startPage') }}/img/arrow-right.png"></a></li>
                </ul>
            </div>
            <div class="col-md-2 linkStyle">
                <h3>Convert:</h3>
                <ul>
                    <li exchange2="EUR" exchange1="USD" id="USDEUR" data-title="" class="exchange_pair" data-usd="0"><a href="/calculator/usd-eur">USD to EUR</a></li>
                    <li exchange2="BTC" exchange1="USD" id="USDBTC" data-title="" class="exchange_pair" data-usd="0"><a href="/calculator/usd-btc">USD to BTC</a></li>
                    <li exchange2="USD" exchange1="BTC" id="BTCUSD" data-title="" class="exchange_pair" data-usd="0"><a href="/calculator/btc-usd">BTC to USD</a></li>
                    <li exchange2="EUR" exchange1="BTC" id="BTCEUR" data-title="" class="exchange_pair" data-usd="0"><a href="/calculator/btc-eur">BTC to EUR</a></li>
                    <li exchange2="USD" exchange1="AUD" id="AUDUSD" data-title="" class="exchange_pair" data-usd="0"><a href="/calculator/aud-usd">AUD to USD</a></li>
                    <li exchange2="USD" exchange1="EUR" id="EURUSD" data-title="" class="exchange_pair" data-usd="0"><a href="/calculator/eur-usd">EUR to USD</a></li>
                    <li exchange2="CAD" exchange1="BTC" id="BTCCAD" data-title="" class="exchange_pair" data-usd="0"><a href="/calculator/btc-cad">BTC to CAD</a></li>
                    <li exchange2="AUD" exchange1="BTC" id="BTCAUD" data-title="" class="exchange_pair" data-usd="0"><a href="/calculator/btc-aud">BTC to AUD</a></li>
                </ul>
            </div>
            <div class="col-md-2 linkStyle">
                <h3>World currency:</h3>
                <ul>
                    <li data-title="US Dollar" id="USD" class="fiat"><a href="/world/us-dollar-exchange-rates">US Dollar</a></li>
                    <li data-title="Euro" id="EUR" class="fiat"><a href="/world/euro-exchange-rates">Euro</a></li>
                    <li data-title="Canadian Dollar" id="CAD" class="fiat"><a href="/world/canadian-dollar-exchange-rates">Canadian Dollar</a></li>
                    <li data-title="Japanese Yen" id="JPY" class="fiat"><a href="/world/japanese-yen-exchange-rates">Japanese Yen</a></li>
                    <li data-title="Australian Dollar" id="AUD" class="fiat"><a href="/world/australian-dollar-exchange-rates">Australian Dollar</a></li>
                    <li data-title="Swiss Franc" id="Swiss Franc" class="fiat"><a href="/world/swiss-franc-exchange-rates">Swiss Franc</a></li>
                    <li data-title="Chinese Yuan Renminbi" id="CNY" class="fiat"><a href="/world/chinese-yuan renminbi-exchange-rates">Chinese Yuan Renminbi</a></li>
                    <li data-title="Croatian Kuna" id="HRK" class="fiat"><a href="/world/croatian-kuna-exchange-rates">Croatian Kuna</a></li>
                </ul>
            </div>
            <div class="col-md-2 linkStyle">
                <h3>Cryptocurrency:</h3>
                <ul>
                    <li data-title="Bitcoin" id="BTC" class="crypto"><a href="/crypto/bitcoin">Bitcoin</a></li>
                    <li data-title="Ethereum" id="ETH" class="crypto"><a href="/crypto/ethereum">Ethereum</a></li>
                    <li data-title="Ripple" id="XRP" class="crypto"><a href="/crypto/ripple">Ripple</a></li>
                    <li data-title="Bitcoin Cash" id="BCH" class="crypto"><a href="/crypto/bitcoin-cash">Bitcoin Cash</a></li>
                    <li data-title="Litecoin" id="LTC" class="crypto"><a href="/crypto/litecoin">Litecoin</a></li>
                    <li data-title="Dashcoin" id="DASH" class="crypto"><a href="/crypto/dashcoin">Dashcoin</a></li>
                    <li data-title="NEO" id="NEO" class="crypto"><a href="/crypto/neo">NEO</a></li>
                    <li data-title="NEM" id="XEM" class="crypto"><a href="/crypto/nem">NEM</a></li>
                </ul>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <footer class="menu-footer footer">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-xs-12 total">Total Market Cap: ${{ number_format(session()->get('totalMarketCap')) }}</div>
            <div class="col-sm-6 col-md-6 col-xs-12 date" id="datetime"></div>
        </div>
    </footer>
</section>