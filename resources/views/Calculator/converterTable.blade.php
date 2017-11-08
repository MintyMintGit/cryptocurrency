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
                <div class="btn-group bootstrap-select">
                    <input id="from" class="btn dropdown-toggle btn-default" data-toggle="dropdown" is_crypto="false" price_usd = "1"
                           role="button" title="USD"></input>

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
                    <input id="to" class="btn dropdown-toggle btn-default" data-toggle="dropdown" is_crypto="false" price_usd = "{{ $harcodedEur }}"  role="button" title="EU to US Dollar"></input>
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
<style>
    .calc-custom-form{
        position: relative;
    }
    .calc-custom-form input {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        color: #000;
        text-align: left;
        width: 100%;
    }
    .calc-custom-form span.bs-caret {
        height: 32px !important;
        top: 1px !important;
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
        right: 1px !important;
        text-align: center;
        padding-top: 3px;
        cursor: pointer;
    }
    .calc-custom-form .dropdown{
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        float: left;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        font-size: 14px;
        text-align: left;
        list-style: none;
        background-color: #fff;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 4px;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        width: 100%;
        max-height: 400px;
        overflow-x: scroll;
        display: none;
    }
    .calc-custom-form .dropdown ul{
        padding: 0;
    }
    .calc-custom-form .dropdown li {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
    }
    .calc-custom-form .dropdown li:hover{
        background-color: #f9f9f9;
        cursor: pointer;
    }
</style>
    <div class="container-fluid date">
        <h2 id="dataModalWindow">Wednesday, October 18, 2017, week 42</h2>
        <span id="dataModalWindowRight"></span>
        <p>Trending: Top Currency Pairs</p>
    </div>
</div>
