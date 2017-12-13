<div class="container-fluid page-content">

    {{--<div class="container-fluid top-info">--}}
        {{--<h1 class="text-uppercase">convert <span id="fromSecond">{{ $currencyFrom->fullName }}</span> to <span id="toSecond">{{ $currencyTo->fullName }}</span></h1>--}}
        {{--<p><span id="fromThird">{{ strtoupper($currencyFrom->shortName) }}</span>/<span id="toThird">{{ strtoupper($currencyTo->shortName) }}</span> Currency Calculator<br>--}}
            {{--Update: <a id="updatedLast" href="#">5 minutes ago</a></p>--}}
    {{--</div>--}}

    <div class="container-fluid top-info">
        @if ($showHardcodedHeader != false)
            <h1 class="text-uppercase">{{$showHardcodedHeader}}</h1>
            @if ($showHardcodedHeaderSecond != false)
                <p class="text-capitalize nopadding">{{ $showHardcodedHeaderSecond }}</p>
            @endif
        @else
            <h1 class="text-uppercase">convert <span id="fromSecond">{{ $currencyFrom->fullName }}</span> to <span id="toSecond">{{ $currencyTo->fullName }}</span></h1>
            <p><span id="fromThird">{{ strtoupper($currencyFrom->shortName) }}</span>/<span id="toThird">{{ strtoupper($currencyTo->shortName) }}</span> Currency Calculator<br>

        @endif
                Update: <a id="updatedLast" href="#">5 minutes ago</a></p>
    </div>

    <div class="container main-info">
        <div class="big-num">
                <span class="first">
                    <div class="top-num">
                        <span class="blue"> <span id="amountBlue"> {{ $amount }} </span>  <span id="amountFromCurrency">{{ strtoupper($currencyFrom->shortName) }}</span></span>
                        =
                    </div>
                    <span id="inetgerNum">0.</span>
                </span><span class="blue" id="decimal">85</span><span class="gray" id="thousands">540</span>
            <span id="amountToCurrency" class="cur">{{ strtoupper($currencyTo->shortName) }}</span>
        </div>
    </div>

    <div class="filters container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <input type="number" class="form-control" value="{{ $amount }}" id="amount" placeholder="1">
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="calc-custom-form">
                    <div class="input-wrap">
                        <input type="search" crypto="{{ $currencyFrom->crypto }}" id="from" value="{{ strtoupper($currencyFrom->shortName) }}" price_usd="{{ $currencyFrom->price_usd }}">
                        <span class="bs-caret"><span class="caret"></span></span>
                    </div>
                    <div class="dropdown" id="autoFrom">
                        <ul>
                            <li>UAH</li>
                            <li>USD</li>
                            <li>RMB</li>
                            <li>EUR</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="calc-custom-form">
                    <div class="input-wrap">
                        <input type="search" crypto="{{ $currencyTo->crypto }}" id="to" value="{{ strtoupper($currencyTo->shortName) }}" price_usd="{{ $currencyTo->price_usd }}">
                        <span class="bs-caret"><span class="caret"></span></span>
                    </div>
                    <div class="dropdown" id="autoTo">
                        <ul>
                            <li>UAH</li>
                            <li>USD</li>
                            <li>RMB</li>
                            <li>EUR</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 action">
                <a id="inversion" href="calculator/{{ $currencyFrom->shortName }}-{{ $currencyTo->shortName }}?{{ $amount }}">Invert currencies</a>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid date">
        <h2 id="dataModalWindow">Wednesday, October 18, 2017, week 42 <span id="dataModalWindowRight"></span></h2>

        <p>Trending: Top Currency Pairs</p>
    </div>
</div>
