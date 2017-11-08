<div class="container-fluid page-content">

    <div class="container-fluid top-info">
        <h1><span id="fromSecond">US Dollar</span> to <span id="toSecond">Euro</span></h1>
        <p><span id="fromThird">USD</span>/<span id="toThird">EURO</span> Currency Calculator<br>
            Update: <a id="updatedLast" href="#">5 minutes ago</a></p>
    </div>

    <div class="container main-info">
        <div class="big-num">
                <span class="first">
                    <div class="top-num">
                        <span class="blue"> <span id="amountBlue"> 1.00 </span>  <span id="amountFromCurrency">USD</span></span>
                        =
                    </div>
                    <span id="inetgerNum">0.</span>
                </span><span class="blue" id="decimal">85</span><span class="gray" id="thousands">540</span><span id="amountToCurrency" class="cur">EUR</span>
        </div>
    </div>

    <div class="filters container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <input type="number" class="form-control" value="1" id="amount" placeholder="1">
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="calc-custom-form">
                    <div class="input-wrap">
                        <input type="search">
                        <span class="bs-caret"><span class="caret"></span></span>
                    </div>
                    <div class="dropdown">
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
                        <input type="search">
                        <span class="bs-caret"><span class="caret"></span></span>
                    </div>
                    <div class="dropdown">
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
                <a id="inversion" href="#">Invert currencies</a>
            </div>
        </div>
    </div>
                {{--<div class="btn-group bootstrap-select">--}}
                    {{--<input data-live-search=“true” id="to" class="btn dropdown-toggle btn-default" data-toggle="dropdown" is_crypto="false" price_usd = "{{ $harcodedEur }}"  role="button" title="EU to US Dollar"></input>--}}
                    {{--<div class="dropdown-menu open" role="combobox">--}}
                        {{--<ul id="toAuto" class="dropdown-menu inner" role="listbox" aria-expanded="false">--}}

                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<select id="toAuto" class="selectpicker" tabindex="-98">--}}
                    {{--</select>--}}
            {{--</div>--}}
            <div class="col-md-3 col-sm-3 col-xs-12 action">
                <a id="inversion" href="#">Invert currencies</a>
            </div>
        </div>
    </div>
    <div class="container-fluid date">
        <h2 id="dataModalWindow">Wednesday, October 18, 2017, week 42</h2>
        <span id="dataModalWindowRight"></span>
        <p>Trending: Top Currency Pairs</p>
    </div>
</div>
