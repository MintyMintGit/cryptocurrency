@extends('layouts.master')

@section('content')

    <input type="hidden" id="viewAllLink" value="{{route('displayAll')}}" >
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">

    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="hidden-xs hidden-sm col-md-4">
                    <ul id="category-tabs" class="nav nav-tabs text-left" role="tablist">
                        <li class="active">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> All <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/">Top 100</a></li>
                                <li><a href="/all/views/all/">Full List</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Coins <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/coins/">Top 100</a></li>
                                <li><a href="/coins/views/all/">Full List</a></li>
                                <li class="divider"></li>
                                <li><a href="/coins/">Market Cap by Circulating Supply</a></li>
                                <li><a href="/coins/views/market-cap-by-total-supply/">Market Cap by Total Supply</a></li>
                                <li><a href="/coins/views/filter-non-mineable/">Filter Non-Mineable</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Tokens <span class="caret"></span> </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/tokens/">Top 100</a></li>
                                <li><a href="/tokens/views/all/">Full List</a></li>
                                <li class="divider"></li>
                                <li><a href="/tokens/">Market Cap by Circulating Supply</a></li>
                                <li><a href="/tokens/views/market-cap-by-total-supply/">Market Cap by Total Supply</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="col-xs-4 col-md-4 text-left">
                    <div id="currency-switch" class="btn-group">
                        <button id="currency-switch-button" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            USD <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu text-center" role="menu">


                            <li class="pointer"><a href="#USD" class="price-toggle" data-currency="usd">USD</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#BTC" class="price-toggle" data-currency="btc">BTC</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#ETH" class="price-toggle" data-currency="eth">ETH</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#AUD" class="price-toggle" data-currency="aud">AUD</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#BRL" class="price-toggle" data-currency="brl">BRL</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#CAD" class="price-toggle" data-currency="cad">CAD</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#CHF" class="price-toggle" data-currency="chf">CHF</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#CLP" class="price-toggle" data-currency="clp">CLP</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#CNY" class="price-toggle" data-currency="cny">CNY</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#CZK" class="price-toggle" data-currency="czk">CZK</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#DKK" class="price-toggle" data-currency="dkk">DKK</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#EUR" class="price-toggle" data-currency="eur">EUR</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#GBP" class="price-toggle" data-currency="gbp">GBP</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#HKD" class="price-toggle" data-currency="hkd">HKD</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#HUF" class="price-toggle" data-currency="huf">HUF</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#IDR" class="price-toggle" data-currency="idr">IDR</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#ILS" class="price-toggle" data-currency="ils">ILS</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#INR" class="price-toggle" data-currency="inr">INR</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#JPY" class="price-toggle" data-currency="jpy">JPY</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#KRW" class="price-toggle" data-currency="krw">KRW</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#MXN" class="price-toggle" data-currency="mxn">MXN</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#MYR" class="price-toggle" data-currency="myr">MYR</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#NOK" class="price-toggle" data-currency="nok">NOK</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#NZD" class="price-toggle" data-currency="nzd">NZD</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#PHP" class="price-toggle" data-currency="php">PHP</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#PKR" class="price-toggle" data-currency="pkr">PKR</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#PLN" class="price-toggle" data-currency="pln">PLN</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#RUB" class="price-toggle" data-currency="rub">RUB</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#SEK" class="price-toggle" data-currency="sek">SEK</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#SGD" class="price-toggle" data-currency="sgd">SGD</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#THB" class="price-toggle" data-currency="thb">THB</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#TRY" class="price-toggle" data-currency="try">TRY</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#TWD" class="price-toggle" data-currency="twd">TWD</a></li>
                            <li class="divider"></li>
                            <li class="pointer"><a href="#ZAR" class="price-toggle" data-currency="zar">ZAR</a></li>
                            <li class="divider"></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-8 col-md-4 text-right">
                    <div class="clear"></div>
                    <div class="pull-right">
                        <ul class="pagination top-paginator">

                            <li><a href="1">← Previous 100</a></li>


                            <li><a href="3">Next 100  →</a></li>

                            <li><a id="ViewAll" href="/api/displayAll">View All</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <table id="marketCapitalizations">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Market Cap</th>
                    <th>Price</th>
                    <th>Circulating supply</th>
                    <th>Volume (24h)</th>
                    <th>% Change (24h)</th>
                    <th>Price Graph (7d)</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>


@endsection