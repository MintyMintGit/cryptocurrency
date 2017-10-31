@extends('layouts.master')

@section('content')



<link href="/css/cryptoIcons.css" rel="stylesheet" type="text/css">
    <input type="hidden" id="viewAllLink" value="{{route('displayAll')}}" >
    <input type="hidden" id="GlobalDataLink" value="{{route('getGlobalDataApi')}}" >

    <input type="hidden" id="bitcoinPrice" value="{{$bitcoinPrice}}">
    <input type="hidden" id="ethPrice" value="{{$ethPrice}}">
    <input type="hidden" id="saveStatistic" value="{{ route('saveStatistic') }}">


<div class="home">
    <div class="container-fluid nav-page">
        <a id="tab1" href="" class="currency-converner-head-btn"><i class="fa fa-calculator" aria-hidden="true"></i>Currency Converter</a>
    </div>
        <div class="col-xs-12">

            <!--began work-->
            <section class="content container-fluid">
                <div class="filter-area">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 left" >
                            <div class="btn-group bootstrap-select show-tick">
                                <button type="button" class="btn dropdown-toggle bs-placeholder btn-default"
                                        data-toggle="dropdown" role="button" title="Market Cap"><span
                                            class="filter-option pull-left">Market Cap</span>&nbsp;<span
                                            class="bs-caret"><span class="caret"></span></span></button>
                                <div class="dropdown-menu open" role="combobox">
                                    <ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
                                        <li data-original-index="0"><a href="{{ route('startPage') }}" tabindex="0" class="" data-tokens="null"
                                                                       role="option" aria-disabled="false"
                                                                       aria-selected="false"><span
                                                        class="text">ALL</span><span
                                                        class="glyphicon glyphicon-ok check-mark"></span></a></li>
                                        <li data-original-index="1"><a href="{{ route('crypto') }}" tabindex="0" class="" data-tokens="null"
                                                                       role="option" aria-disabled="false"
                                                                       aria-selected="false"><span
                                                        class="text">Crypto</span><span
                                                        class="glyphicon glyphicon-ok check-mark"></span></a></li>
                                    </ul>
                                </div>
                                <select class="selectpicker" multiple="" title="Market Cap" tabindex="-98">
                                    <option>ALL</option>
                                    <option>Crypto</option>
                                </select></div>
                            <div class="btn-group bootstrap-select show-tick">
                                <button type="button" class="btn dropdown-toggle bs-placeholder btn-default"
                                        data-toggle="dropdown" role="button" title="Tools"><span
                                            class="filter-option pull-left">Tools</span>&nbsp;<span
                                            class="bs-caret"><span class="caret"></span></span></button>
                                <div class="dropdown-menu open" role="combobox">
                                    <ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
                                        <li data-original-index="0">
                                            <a href="{{ route('calculator') }}" tabindex="0" class="" data-tokens="null"
                                                                       role="option" aria-disabled="false"
                                                                       aria-selected="false">
                                                <span class="text">Curency Converter Calculator</span>
                                                <span class="glyphicon glyphicon-ok check-mark"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <select class="selectpicker" multiple="" title="Tools" tabindex="-98">
                                    <option>Curency Converter Calculator</option>
                                </select></div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12 right">
                            <div class="currency-selector">
                                <div class="btn-group bootstrap-select">
                                    <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown"
                                            role="button" title="USD DOLLAR">
                                        <span id="currency-switch-button" class="filter-option pull-left">USD DOLLAR</span>&nbsp;<span class="bs-caret">
                                            <span class="caret"></span></span>
                                    </button>
                                    <div class="dropdown-menu open" role="combobox">
                                        <ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
                                            <!--start something-->

                                            <!--end something -->
                                            <li data-original-index="0" class="pointer selected">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#BTC" data-currency="btc"
                                                   role="option"
                                                   aria-disabled="false"
                                                   aria-selected="true"><span
                                                            class="text">BTC</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span></a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#ETH" data-currency="eth"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">ETH</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#AUD" data-currency="aud"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">AUD</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#BRL" data-currency="brl"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">BRL</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#CAD" data-currency="cad"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">CAD</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>

                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#CHF" data-currency="chf"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">CHF</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#CLP" data-currency="clp"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">CLP</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#CNY" data-currency="cny"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">CNY</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#CZK" data-currency="czk"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">CZK</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#DKK" data-currency="dkk"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">DKK</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#EUR" data-currency="eur"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">EUR</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#GBP" data-currency="gbp"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">GBP</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#HKD" data-currency="hkd"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">HKD</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#HUF" data-currency="huf"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">HKD</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#IDR" data-currency="idr"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">HKD</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#ILS" data-currency="ils"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">ILS</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#INR" data-currency="inr"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">INR</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#JPY" data-currency="jpy"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">JPY</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#KRW" data-currency="krw"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">KRW</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#MXN" data-currency="mxn"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">MXN</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#MYR" data-currency="myr"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">MYR</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#NOK" data-currency="nok"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">NOK</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null"href="#NZD" data-currency="nzd"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">NZD</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#PHP" data-currency="php"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">PHP</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#PKR" data-currency="pkr"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">PKR</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#PLN" data-currency="pln"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">PLN</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null"  href="#RUB" data-currency="rub"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">RUB</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#SEK" data-currency="sek"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">SEK</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#SGD" data-currency="sgd"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">SGD</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#THB" data-currency="thb"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">THB</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#TRY" data-currency="try"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">TRY</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#TWD" data-currency="twd"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">TWD</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                            <li data-original-index="1">
                                                <a tabindex="0" class="pointer" data-tokens="null" href="#ZAR" data-currency="zar"
                                                   role="option" aria-disabled="false"
                                                   aria-selected="false"><span class="text">ZAR</span><span
                                                            class="glyphicon glyphicon-ok check-mark"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <select class="selectpicker" tabindex="-98">
                                        <option>USD DOLLAR</option>
                                        <option>EU EURO</option>
                                        <option>RMB YUAN</option>
                                        <option>UA HRYVHA</option>
                                        <option>HK DOLLAAR</option>
                                    </select></div>
                            </div>
                            <div class="form-group search-filter">
                                <div class="icon-addon addon-lg">
                                    <input type="search" placeholder="Search..." class="form-control"
                                           id="search_filter_input">
                                    <label for="search_filter_input" class="glyphicon glyphicon-search" rel="tooltip"
                                           title="search"></label>
                                </div>
                            </div>
                            <nav class="nav-filter">
                                <a id="previousLink" href="1"><span class="next">← Previous 100</span></a>
                                <a id="nextLink" href="3"><span class="next">Next 100 ⟶</span></a>
                                <a id="ViewAll" href="/api/displayAll"><span class="viev-all">View All</span></a>

                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end work-->
            <section class="main-table">
                <table id="marketCapitalizations">
                    <thead>
                    <tr>
                        <th class="num-h" scope="col">#</th>
                        <th class="name-h" scope="col">Name</th>
                        <th scope="col">Market Cap</th>
                        <th scope="col">Price</th>
                        <th class="supply-h">Circulating supply</th>
                        <th class="volume-h">Volume (24h)</th>
                        <th scope="col">% Change (24h)</th>
                        <th scope="col">Price Graph (7d)</th>
                    </tr>
                    </thead>

                </table>
            </section>
            @include('layouts.partials._menu')
        </div>
</div>


@include('Calculator.index', $CloudsOfCurrencies)




@endsection