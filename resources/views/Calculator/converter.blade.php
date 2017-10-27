@extends('layouts.master')

@section('content')
<div class="converter">
    <input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
    <input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">

    <div class="container-fluid nav-page">
        <a class="currency-converner-head-btn"><i class="fa fa-calculator" aria-hidden="true"></i>&lt; Back to List</a>
    </div>

    <div class="container-fluid page-content">


        <div class="container main-info">
            <div class="big-num">
                <span class="first">
                    <div class="top-num">
                        <span class="blue"> <span id="amountBlue"> 1.00 </span>  <span id="amountFromCurrency">USD</span></span>
                        =
                    </div>
                    <span id="inetgerNum">
0.
                    </span>
                </span>
                <span class="blue" id="decimal">85</span>
                <span class="gray" id="thousands">540</span>
                <span id="amountToCurrency" class="cur">EUR</span>

            </div>
        </div>

        <div class="filters container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <input type="number" class="form-control" id="amount" placeholder="1">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="btn-group bootstrap-select">
                        <input id="from" class="btn dropdown-toggle btn-default" data-toggle="dropdown"
                                role="button" title="EU to US Dollar"> </input>

                        <div class="dropdown-menu open" role="combobox">
                            <ul id="fromAuto" class="dropdown-menu inner" role="listbox" aria-expanded="false">
                            </ul>
                        </div>
                        <select class="selectpicker" tabindex="-98">
                            <option>EU to US Dollar</option>
                            <option>EU to US Dollar</option>
                            <option>EU to US Dollar</option>
                        </select></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="btn-group bootstrap-select">
                        <input id="to" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="EU to US Dollar"></input>
                        <div class="dropdown-menu open" role="combobox">
                            <ul id="toAuto" class="dropdown-menu inner" role="listbox" aria-expanded="false">

                            </ul>
                        </div>
                        <select class="selectpicker" tabindex="-98">
                            <option>EU to US Dollar</option>
                            <option>EU to US Dollar</option>
                            <option>EU to US Dollar</option>
                        </select></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 action">
                    <a id="inversion" href="#">Convert Currencies</a>
                </div>
            </div>
        </div>
    </div>

    @include("Calculator.TrendingRates")


    @include("Calculator.cloudOfCurrencies")



    <section class="menu-mask">
        <a href="#">
            <div class="head-logo" style="display: none;">Crypto Converter</div>
        </a>
        <div class="x" style="display: none;"></div>
        <div class="container-fluid menu-container" style="padding-top: 50px;">
            <div class="row">
                <div class="col-md-4 nav">
                    <h3>Menu</h3>
                    <ul>
                        <li><a href="#"><i class="fa fa-calculator" aria-hidden="true"></i>Currency calculator<img
                                        class="arrow" width="27" height="19" src="img/arrow-right.png"></a></li>
                        <li><a href="#"><i class="fa fa-btc" aria-hidden="true"></i>Crypto Currencies Profile<img
                                        class="arrow" width="27" height="19" src="img/arrow-right.png"></a></li>
                        <li><a href="#"><i class="fa fa-globe" aria-hidden="true"></i>World Currencies profile<img
                                        class="arrow" width="27" height="19" src="img/arrow-right.png"></a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3>Convert:</h3>
                    <ul>
                        <li><a href="">EUR to USD</a></li>
                        <li><a href="">EUR to USD</a></li>
                        <li><a href="">EUR to USD</a></li>
                        <li><a href="">EUR to USD</a></li>
                        <li><a href="">EUR to USD</a></li>
                        <li><a href="">EUR to USD</a></li>
                        <li><a href="">EUR to USD</a></li>
                        <li><a href="">EUR to USD</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3>Cryptocurrency:</h3>
                    <ul>
                        <li><a href="">Bitcoin</a></li>
                        <li><a href="">Bitcoin</a></li>
                        <li><a href="">Bitcoin</a></li>
                        <li><a href="">Bitcoin</a></li>
                        <li><a href="">Bitcoin</a></li>
                        <li><a href="">Bitcoin</a></li>
                        <li><a href="">Bitcoin</a></li>
                        <li><a href="">Bitcoin</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3>Fiat currency:</h3>
                    <ul>
                        <li><a href="">USD - US Dollar</a></li>
                        <li><a href="">USD - US Dollar</a></li>
                        <li><a href="">USD - US Dollar</a></li>
                        <li><a href="">USD - US Dollar</a></li>
                        <li><a href="">USD - US Dollar</a></li>
                        <li><a href="">USD - US Dollar</a></li>
                        <li><a href="">USD - US Dollar</a></li>
                        <li><a href="">USD - US Dollar</a></li>
                    </ul>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <footer class="menu-footer footer">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-xs-12 total">Total Market Cap: $172,759,034,864</div>
                <div class="col-sm-6 col-md-6 col-xs-12 date">08:14pm 10.29.2017</div>
            </div>
        </footer>
    </section>
</div>

@endsection