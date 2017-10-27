@extends('layouts.master')

@section('content')
<div class="converter">
    <input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
    <input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">

    <div class="container-fluid nav-page">
        <a href="{{ route('startPage') }}" class="currency-converner-head-btn"><i class="fa fa-calculator" aria-hidden="true"></i>&lt; Back to List</a>
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

    @include('layouts.partials._menu')

</div>

@endsection